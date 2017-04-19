<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class TeacherController extends Controller
{

    public function index(){
        $message = Session::get('message');
        Log::info("Message: ".$message);
        if(isset($message)) $message = json_decode($message);
        $status = (isset($message))?$message->status:null;
        $description = (isset($message))?$message->description:null;
        return view('managements.teachers.index')->with(['status'=>$status, 'description'=>$description]);
    }

    public function comboboxteacher(){
        $client = new Client();
        $req = $client->request('GET','https://serviceschoolmate.herokuapp.com/teacher');
        $res = $req->getBody();
        $data = json_decode($res);
        return json_encode(['teachers'=>$data->teachers]);
    }

    public function teacherDataTables(){
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/teacher');
        $res = $req->getBody();
        $data = json_decode($res);
        $teachers = $data->teachers;

        $collections = collect();
        foreach ($teachers as $teacher){
            $arr = array(
                'teacherName' =>    $teacher->teacherName,
                'teacherBirthDate'=>$teacher->teacherBirthDate,
                'teacherPhone'=>$teacher->teacherPhone,
                'teacherEmail'=> $teacher->teacherEmail,
                'teacherAddress'=>$teacher->teacherAddress,
                'action'=>"<a class='btn btn-primary glyphicon glyphicon-eye-open' title='View' onclick= 'showViewParent(".$teacher->teacherID.")'></a>
                            <a class='btn btn-primary glyphicon glyphicon-edit' title='Edit' onclick= 'showEditTeacher(".$teacher->teacherID.")'></a>
                                        <a class='btn btn-danger glyphicon glyphicon-trash' title='Delete'
                                            onclick = 'showDeleteTeacher($teacher->teacherID);'></a> ");
            $collections->push($arr);
        }
        $message = $data->message;

        return Datatables::collection($collections)
            ->make();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $teacher = [
            'teacherName' => $request->teacherName,
            'teacherEmail' => $request->teacherEmail,
            'teacherPhone'   => $request->teacherPhone,
            'teacherBirthDate' => $request->teacherBirthDate,
            'teacherAddress' => $request->teacherAddress
        ];
        $data = json_encode($teacher);
        //dd($data);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('POST', 'https://serviceschoolmate.herokuapp.com/teacher', array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $res= $req->getBody();
        $data = json_decode($res);
        //dd($data);
        $message = json_encode($data->message);
        return Redirect::to('/teacher')->with('message', $message);
    }


    public function show($teacherID)
    {
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/teacher'.$teacherID);
        $res = $req->getBody();
        $data = json_decode($res);
        $teacher = $data->teacher;
        return ($teacher) ? json_encode($teacher) : view('templates.notFound');
    }

    public function edit($teacherID)
    {
        $client = new Client();
        $req = $client->request('GET', 'https://serviceschoolmate.herokuapp.com/teacher'.$teacherID.'/edit');
        $res = $req->getBody();
        $data = json_decode($res);
        $teacher = $data->teacher;
        //$message = $data->message;
        return json_encode($teacher);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
