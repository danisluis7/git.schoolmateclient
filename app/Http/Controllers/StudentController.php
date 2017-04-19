<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;
use Image;

class StudentController extends Controller
{

    public function index(){
        /*$client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/student');
        $res = $req->getBody();
        $data = json_decode($res);
        $students = $data->students;
        dd($students);*/
        $message = Session::get('message');
        if(isset($message)) $message = json_decode($message);
        $status = (isset($message))?$message->status:null;
        $description = (isset($message))?$message->description:null;

        return view('managements.students.index')->with(['status'=>$status, 'description'=>$description]);
    }

    public function studentDataTables(){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/student');
        $res = $req->getBody();
        $data = json_decode($res);
        $students = $data->students;

        $collections = collect();
        foreach ($students as $student){
            $arr = array(
                'studentName' =>    $student->studentName,
                'studentSex'=>$student->studentSex,
                'studentBirthDate'=>$student->studentBirthDate,
                'studentAvatar'=>(!is_null($student->avatar) && $student->avatar != '')?"<img src='http://127.0.0.1:8000/resources/assets/images/".$student->avatar."' style='width: 100%' />":"",
                'parentName'=>$student->parent->parentName,
                'className'=> $student->class_relationship->className,
                'busNumber'=>$student->bus->busNumber,
                'action'=>"<a class='btn btn-primary glyphicon glyphicon-eye-open' title='View' onclick= 'showViewStudent(".$student->studentID.")'></a>
                            <a class='btn btn-primary glyphicon glyphicon-edit' title='Edit' onclick= 'showEditStudent(".$student->studentID.")'></a>
                                        <a class='btn btn-danger glyphicon glyphicon-trash' title='Delete'
                                            onclick = 'showDeleteStudent($student->studentID);'></a> ");
            $collections->push($arr);
        }
        $message = $data->message;

        return Datatables::collection($collections)
            ->make();
    }

    public function objectsRelativeToStudent(){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/objectsRelativeToStudent');
        $res = $req->getBody();
        return $res;
        //$data = json_decode($req);

    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $file = Input::file('avatar');
        $avatar = (string) Image::make($file)->encode('data-url');
        $student = [
            'studentName' => $request->studentName,
            'studentSex' => $request->studentSex,
            'studentBirthDate' => $request->studentBirthDate,
            'parentID' => $request->parentID,
            'classID' => $request->classID,
            'busID' => $request->busID,
            'avatar'   => $avatar,
        ];
        $data = json_encode($student);
        //dd($data);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('POST', 'http://localhost:8000/student', array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $res= $req->getBody();
        $data = json_decode($res);
        //dd($data);
        $message = json_encode($data->message);
        return Redirect::to('/student')->with('message', $message);
    }


    public function show($studentID)
    {
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/student/'.$studentID);
        $res = $req->getBody();
        $data = json_decode($res);
        $student = $data->student;
        return ($student) ? json_encode($student) : view('templates.notFound');
    }

    public function edit($studentID)
    {
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/student/'.$studentID.'/edit');
        $res = $req->getBody();
        $data = json_decode($res);
        $student = $data->student;
        //$message = $data->message;
        return json_encode($student);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function studentByClass($classID){
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/studentByClass/'.$classID);
        $res = $req->getBody();
        $data = json_decode($res);
        $students = $data->students;
        //$message = $data->message;
        return json_encode(['students' => $students]);
    }
}
