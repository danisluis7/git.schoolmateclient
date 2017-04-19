<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;

class SubjectController extends Controller
{
    //
    public function index()
    {
        $client = new Client();
        $req = $client->request('GET','http://serviceschoolmate.herokuapp.com/subject');
        $res = $req->getBody();
        $data = json_decode($res);
        return json_encode(['subjects'=>$data->subjects]);
    }
}
