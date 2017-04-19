<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Image;
use Intervention\Image\Exception\NotReadableException;
use League\Flysystem\Exception;
use Yajra\Datatables\Facades\Datatables;
//http://www.core45.com/using-database-to-store-images-in-laravel-5-1/
//https://laravel.io/forum/02-17-2014-how-do-you-save-image-to-database-and-display-it-on-website
//http://stackoverflow.com/questions/11511511/how-to-save-a-png-image-server-side-from-a-base64-data-string

class UserController extends Controller
{
    public function index(){
        $message = Session::get('message');
        Log::info("Message: ".$message);
        if(isset($message)) $message = json_decode($message);
        $status = (isset($message))?$message->status:null;
        $description = (isset($message))?$message->description:null;
        //Log::info("Status: ".$status."   Description".$description);

        return view('managements.users.index')->with(['status'=>$status, 'description'=>$description]);
        /*$client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/user');

        $res = $req->getBody();
        $data = json_decode($res);
        $users = $data->users;
        $message = $data->message;
        dd(json_encode($users));*/
        /*foreach ($users as $user){
            dd($user->group_user->groupUserName);
        }*/

    }

    public function userDataTables(){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/user');
        $res = $req->getBody();
        $data = json_decode($res);
        $users = $data->users;

        $collections = collect();
        foreach ($users as $user){
            /*try{
                $profilePicture = Image::make($user->avatar);
                Response::make($profilePicture->encode('data-url'));
            }catch(NotReadableException $e){
                $profilePicture = null;
            }*/
            $arr = array('email'=> $user->email,
                            'phoneNumber'=>$user->phoneNumber,
                            //'avatar'=>(!is_null($profilePicture))?"<img src='http://127.0.0.1:8000/resources/assets/images/".$user->avatar."' style='width: 100%' />":"",
                            'avatar'=>(!is_null($user->avatar) && $user->avatar != '')?"<img src='http://127.0.0.1:8000/resources/assets/images/".$user->avatar."' style='width: 100%' />":"",
                            'group'=>$user->group_user->groupUserName,
                            'action'=>"<a class='btn btn-primary glyphicon glyphicon-eye-open' title='View' onclick= 'showViewUser(".$user->userID.")'></a>
                                        <a class='btn btn-primary glyphicon glyphicon-edit' title='Edit' onclick= 'showEditUser(".$user->userID.")'></a>
                                        <a class='btn btn-danger glyphicon glyphicon-trash' title='Delete'
                                            onclick = 'showDeleteUser($user->userID);'></a> ");
            $collections->push($arr);
        }
        $message = $data->message;

        return Datatables::collection($collections)
            /*->removeColumn('userID')
            ->removeColumn('groupUserID')
            ->removeColumn('group_user')
            ->addColumn('Group', function ($model){
                return $model->group_user->groupUserName;
            })
            ->addColumn('Action', function ($model){
                return $model->email;
            })*/
            ->make();
    }

    public function show($userID){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/user/'.$userID);
        $res = $req->getBody();
        $data = json_decode($res);
        $user = $data->user;
        return ($user) ? json_encode($user) : view('templates.notFound');
    }

    public function edit($userID){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/user/'.$userID.'/edit');
        $res = $req->getBody();
        $data = json_decode($res);

        $user = $data->user;
        $permissions = $data->permissions;
        $message = $data->message;

        return json_encode(['user' => $user, 'permissions' => $permissions]);
    }

    public function store(Request $request){
        $file = Input::file('avatar');
        $avatar = (string) Image::make($file)->encode('data-url');
        $user = [
            'email' => $request->email,
            'phoneNumber'   => $request->phoneNumber,
            'password'  =>  $request->password,
            'avatar'    => $avatar,
            'groupUserID'   => $request->groupUserID
        ];
        $data = json_encode($user);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('POST', 'http://localhost:8000/user', array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $response = $req->getBody();
        $data = json_decode($response);

        //$user = $data->user;
        /*$profilePicture = Image::make($user->avatar);
        Response::make($profilePicture->encode('data-url'));*/
        $message = json_encode($data->message);
        return Redirect::to('/user')->with('message', $message);
    }

    //get all group user
    public function getAllGroupUser(){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/allgroupuser');
        $res = $req->getBody();
        $data = json_decode($res);

        $groupUser = $data->groupUser;
        $permissions = $data->permissions;
        $message = $data->message;

        return json_encode(['groupUser' => $groupUser, 'permissions' => $permissions]);
    }

    //update 
    public function update($userID, Request $request){
        $file = Input::file('avatar');
        $avatar = (string) Image::make($file)->encode('data-url');
        $user = [
            'userID'    => $userID,
            'phoneNumber'   => $request->phoneNumber,
            'password'  =>  $request->password,
            'avatar'    => $avatar
        ];
        $data = json_encode($user);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('PUT', 'http://localhost:8886/user/'.$userID, array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $response = $req->getBody();
        $data = json_decode($response);
        $message = json_encode($data->message);
        return Redirect::to('/user')->with('message', $message);
    }
}
