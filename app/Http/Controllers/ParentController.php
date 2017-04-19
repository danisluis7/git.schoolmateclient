<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class ParentController extends Controller
{
    public function index()
    {
        $message = Session::get('message');
        Log::info("Message: ".$message);
        if(isset($message)) $message = json_decode($message);
        $status = (isset($message))?$message->status:null;
        $description = (isset($message))?$message->description:null;

        return view('managements.parents.index')->with(['status'=>$status, 'description'=>$description]);
    }

    /*Get Parent DataTables*/
    public function parentDataTables(){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/parent');
        $res = $req->getBody();
        $data = json_decode($res);
        $parents = $data->parents;

        $collections = collect();
        foreach ($parents as $parent){
            $arr = array(
                'parentName'    => $parent->parentName,
                'parentEmail'   => $parent->parentEmail,
                'parentPhone'   => $parent->parentPhone,
                'parentBirthDate'=> $parent->parentBirthDate,
                'parentAddress' => $parent->parentAddress,
                'action'        => "<a class='btn btn-primary glyphicon glyphicon-eye-open' title='View' onclick= 'showViewParent(".$parent->parentID.")'></a>
                                        <a class='btn btn-primary glyphicon glyphicon-edit' title='Edit' onclick= 'showEditParent(".$parent->parentID.")'></a>
                                        <a class='btn btn-danger glyphicon glyphicon-trash' title='Delete'
                                            onclick = 'showDeleteParent($parent->parentID);'></a> ");
            $collections->push($arr);
        }
        $message = $data->message;

        return Datatables::collection($collections)->make();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $parent = [
            'parentName' => $request->parentName,
            'parentEmail' => $request->parentEmail,
            'parentPhone'   => $request->parentPhone,
            'parentBirthDate' => $request->parentBirthDate,
            'parentAddress' => $request->parentAddress
        ];
        $data = json_encode($parent);
        //dd($data);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('POST', 'http://localhost:8000/parent', array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $res= $req->getBody();
        $data = json_decode($res);
        //dd($data);
        $message = json_encode($data->message);
        return Redirect::to('/parent')->with('message', $message);
    }

    public function show($parentID)
    {
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/parent/'.$parentID);
        $res = $req->getBody();
        $data = json_decode($res);
        $parent = $data->parent;
        return ($parent) ? json_encode($parent) : view('templates.notFound');
    }

    public function edit($parentID)
    {
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/parent/'.$parentID.'/edit');
        $res = $req->getBody();
        $data = json_decode($res);

        $parent = $data->parent;
        $message = $data->message;

        return json_encode($parent);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
