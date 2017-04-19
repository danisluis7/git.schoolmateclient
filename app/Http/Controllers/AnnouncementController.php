<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class AnnouncementController extends Controller
{

    public function index(){
        $message = Session::get('message');
        /**
         * json_decode: convert JSON to array string or array object.
         * => $message->status or $->message->description:
         * * status or description call fields of array
         * * status or description is two object...
         */
        if(isset($message)) $message = json_decode($message);
        /**
         * If exist array $message and get values of array and assign to another variable
         * and not exist, we assign value is null.
         * After that, we send it to description.
         */
        $status = (isset($message))?$message->status:null;
        $description = (isset($message))?$message->description:null;
        return view('managements.announcement.index')->with(['status'=>$status, 'description'=>$description]);
    }


    /*Get Parent DataTables*/
    public function announcementDataTables(){
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/announcement');
        $res = $req->getBody();
        /**
         * Server response: Json contain variable is $reg. $reg is distinguish with $data
         * $reg: receive from server
         * $data: send to server
         */

        /**
         * You want to view all of object to table
         * transfer from : Json => Array
         */
        $data = json_decode($res);
        /**
         * data->announcements() : method  is created at server, not client
         */
        $announcements = $data->announcements;

        $collections = collect();
        foreach ($announcements as $announcement){
            $arr = array(
                /**
                 * From server: Name of object is Name of table in database Laravel
                 */
                'announcementTitle'    => $announcement->announcementTitle,
                'announcementDescription'   => $announcement->announcementDescription,
                'announcementContent'   => $announcement->announcementContent,
                'announcementDateCreated'=> $announcement->announcementDateCreated,
                'groupAnnouncementID' => $announcement->group_announcement->groupAnnouncementName,
                'action'        => "<a class='btn btn-primary glyphicon glyphicon-eye-open' title='View' onclick= 'showViewAnnouncement(".$announcement->announcementID.")'></a>
                                        <a class='btn btn-primary glyphicon glyphicon-edit' title='Edit' onclick= 'showEditAnnouncement(".$announcement->announcementID.")'></a>
                                        <a class='btn btn-danger glyphicon glyphicon-trash' title='Delete'
                                            onclick = 'showDeleteAnnouncement($announcement->announcementID);'></a> ");
            $collections->push($arr);
        }
        $message = $data->message;

        return Datatables::collection($collections)->make();
    }

    public function create()
    {
        // TODO
    }

    public function objectsRelativeToAnnouncement(){
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/objectsRelativeToAnnouncement');
        $res = $req->getBody();
        return $res;
    }

    public function store(Request $request)
    {
        // $request from form php
        $validators = Validator::make($request->all(), [
            'announcementTitle'  =>  'required|max:50',
            'announcementDescription'   =>  'required|max:255',
            'announcementContent' => 'required'
            ],
            [
                'announcementTitle.required'    => 'The title cannot be blank',
                'announcementTitle.max'   =>  'The Title is less than 50 characters',
                'announcementDescription.required'  =>  'The description cannot be blank',
                'announcementDescription.max'   =>  'The description is less than 255 characters',
                'announcementContent.required' =>  'The content cannot be blank'
            ]);
        if($validators->fails())
            return response()->json([
                'message'  => [
                    'status'    =>  'Error',
                    'description'   => $validators->errors()->all()
                ]
            ]);
        /**
         * Validate sucessfully
         */
        $now = Carbon::now();
        if($request->agreeschoolfee == "yes"){
            $announcement = [
                'announcementTitle' => $request->announcementTitle.'SchoolFees',
                'announcementDescription' => $request->announcementDescription,
                'announcementContent'   => $request->announcementContent.'----'.'agreeschoolfee'.'----'.$request->gradeName,
                'groupAnnouncementID' => 1, /** default  */
                'announcementDateCreated'  => $now->toDateString()." ".$now->toTimeString(),
                'userID' => 1
            ];
        }else if($request->agreeschoolexam == "yes"){
            $announcement = [
                'announcementTitle' => $request->announcementTitle,
                'announcementDescription' => $request->announcementDescription,
                'announcementContent'   => $request->announcementContent.'----'.'agreeschoolexam'.'----'.$request->classID.'----'.$request->subjectName.'----'.$request->time.'----'.$request->teacherName,
                'groupAnnouncementID' => 4, /** default  */
                'announcementDateCreated'  => $now->toDateString()." ".$now->toTimeString(),
                'userID' => 1
            ];
        }else if($request->agreeschoolconference == "yes"){
            $announcement = [
                'announcementTitle' => $request->announcementTitle,
                'announcementDescription' => $request->announcementDescription,
                'announcementContent'   => $request->announcementContent.'----'.'agreeschoolconference'.'----'.$request->groupClassName,
                'groupAnnouncementID' => 3, /** default  */
                'announcementDateCreated'  => $now->toDateString()." ".$now->toTimeString(),
                'userID' => 1
            ];
        }else{
            $announcement = [
                'announcementTitle' => $request->announcementTitle,
                'announcementDescription' => $request->announcementDescription,
                'announcementContent'   => $request->announcementContent.'----'.'agreeschoolactivity',
                'groupAnnouncementID' => 2, /** default  */
                'announcementDateCreated'  => $now->toDateString()." ".$now->toTimeString(),
                'userID' => 1
            ];
        }
        $data = json_encode($announcement);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('POST', 'https://serviceschoolmate.herokuapp.com/announcement', array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $res= $req->getBody();
        $data = json_decode($res);
        $message = json_encode($data->message);
        return Redirect::to('/announcement')->with('message', $message);
    }

    public function show($teacherID)
    {
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/teacher/'.$teacherID);
        $res = $req->getBody();
        $data = json_decode($res);
        $teacher = $data->teacher;
        return ($teacher) ? json_encode($teacher) : view('templates.notFound');
    }

    public function edit($teacherID)
    {
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/teacher/'.$teacherID.'/edit');
        $res = $req->getBody();
        $data = json_decode($res);
        $teacher = $data->teacher;
        //$message = $data->message;
        return json_encode($teacher);
    }
}
