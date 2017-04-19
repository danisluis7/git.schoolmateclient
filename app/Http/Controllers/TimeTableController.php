<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class TimeTableController extends Controller
{

    public function index()
    {
        return view('managements.timetables.index');
    }

    public function timetableDataTables(){
        $classID = Input::get('classID');
        $date = Input::get('date');
        //TODO --
        $client = new Client();
        $req = $client->request('GET', 'http://localhost:8000/timetable?classID='.$classID.'&date='.$date);

        $res = $req->getBody();
        $data = json_decode($res);

        $timetables = $data->timetables;
        $lessons = $data->lessons;
        //dd($timetables);
        return json_encode(['timetables' => $timetables, 'lessons' => $lessons]);

    }


    public function create()
    {
        return view('managements.timetables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function reset(){
        //TODO -- Reset all data of timetable
    }

    //get list weeks od year
    public function weeksOfYear(){
        $client = new Client();
        $req = $client->request('GET', "http://localhost:8000/weekofyear");
        $res = $req->getBody();
        return $res;
    }
}
