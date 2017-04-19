<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class ResultController extends Controller
{
    public function index(){
        $message = Session::get('message');
        Log::info("Message: ".$message);
        if(isset($message)) $message = json_decode($message);
        $status = (isset($message))?$message->status:null;
        $description = (isset($message))?$message->description:null;
        $client = new Client();
        $req = $client->request("GET", "http://localhost:8000/paramsforresult");
        $res = $req->getBody();
        $data = json_decode($res);
        $classes = $data->classes;
        $semesters = $data->semesters;

        $classesCollection = collect(['' => 'Please choose Class']);
        foreach($classes as $class){
            $classesCollection->put($class->classID, $class->className );
        }
        $semestersCollection = collect();
        foreach($semesters as $semester){
            $semestersCollection->put($semester->semesterID, $semester->semesterDescription);
        }

        return view('managements.results.index', compact('status', 'description','classesCollection', 'semestersCollection' ));//->with(['status'=>$status, 'description'=>$description, ]);
    }

    public function resultDataTables(){
        $studentID = Input::get('studentID');
        $semesterID = Input::get('semesterID');
        $client = new Client();
        $req = $client->request("GET", "http://localhost:8000/result?studentID=".$studentID."&semesterID=".$semesterID);
        $res = $req->getBody();
        $data = json_decode($res);
        $resultDetails = $data->resultDetails;
        $collections = collect();
        if ($resultDetails == null){
            return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                    }';
        }
        foreach ($resultDetails as $resultDetail){
            $arr = array(
                'subjectName'   => $resultDetail->subject->subjectName,
                'oralTest'      =>  $resultDetail->oralTest,
                '15mins1'       =>  $resultDetail->{"15 mins 1"},
                '15mins2'       =>  $resultDetail->{'15 mins 2'},
                '45mins1'       =>  $resultDetail->{'45 mins 1'},
                '45mins2'       =>  $resultDetail->{'45 mins 2'},
                'final'         =>  $resultDetail->final,
                'summary'       =>  $resultDetail->summary,
                'teacherName'   =>  $resultDetail->teacher->teacherName,
                'evaluation'    =>  ($resultDetail->evaluation)?$resultDetail->evaluation->evaluationName:null,
                'action'        =>  "<a class='btn btn-primary glyphicon glyphicon-edit' title='Edit' onclick= 'showEditResultDetail(".$resultDetail->resultDetailID.")'></a>");
            $collections->push($arr);
        }

        return Datatables::collection($collections)
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client();
        $req = $client->request("GET", "http://localhost:8000/paramsforresult");
        $res = $req->getBody();
        $data = json_decode($res);
        $classes = $data->classes;
        $semesters = $data->semesters;

        $classesCollection = collect(['' => 'Please choose Class']);
        foreach($classes as $class){
            $classesCollection->put($class->classID, $class->className );
        }
        $semestersCollection = collect();
        foreach($semesters as $semester){
            $semestersCollection->put($semester->semesterID, $semester->semesterDescription);
        }

        return view('managements.results.create', compact('classesCollection', 'semestersCollection' ));
    }

    public function getDataResultCreate(Request $request){
        $data =[
            'classID' => $request->classID,
            'studentID' => $request->studentID,
            'semesterID' => $request->semesterID
        ];
        $data = json_encode($data);
        $client = new Client();
        $req = $client->request("GET", "http://localhost:8000/getDataResultCreate", array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data));

        $res = $req->getBody();
        $data = json_decode($res);
        return $this->makeResultDetailTable($data->resultDetails);

    }

    public function makeResultDetailTable($resultDetails){
         return view('templates.createResultDetailTable', compact('resultDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tableJSON = $request->tableJSON;
        $studentID = $request->studentID;
        $semesterID = $request->semesterID;
        $data = [
            'tableJSON' => $tableJSON,
            'studentID' => $studentID,
            'semesterID'=> $semesterID
        ];
        $data = json_encode($data);
        $client = new Client();
        $req = $client->request("POST", "http://localhost:8000/result", array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $res = $req->getBody();
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($resultDetailID)
    {
        $client = new Client();
        $req = $client->request("GET", "http://localhost:8000/result/".$resultDetailID."/edit");
        $res = $req->getBody();
        $data = json_decode($res);
        $resultDetail = $data->resultDetail;
        return json_encode($resultDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $resultDetailID)
    {
        $resultDetail =  [
            'oralTest' => $request->oralTest,
            '15mins1' => $request->{'15mins1'},
            '15mins2' => $request->{'15mins2'},
            '45mins1' => $request->{'45mins1'},
            '45mins2' => $request->{'45mins2'},
            'final' => $request->final,
            'summary' => ($request->oralTest + $request->{'15mins1'} + $request->{'15mins2'} + $request->{'45mins1'}*2 + $request->{'45mins2'}*2 +$request->final*3)/10,
        ];
        $data = json_encode($resultDetail);
        $client = new Client();
        $req = $client->request('PUT', 'http://localhost:8000/result/'.$resultDetailID, array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        $response = $req->getBody();
        $data = json_decode($response);

        $message = json_encode($data->message);
        //dd($message);
        return Redirect::to('/result')->with('message', $message);
        /*Log::info("ResultDetailID: ".$resultDetailID."    ".
            "OralTest = ".$oralTest.' --- 15mins1 = '.$_15mins1.' --- '.' --- 15mins2 = '.$_15mins2
            .' --- 45mins1 = '.$_45mins1.' --- 45mins2 = '.$_45mins2.' --- final = '.$final.' --- summary = '.$summary);*/
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
