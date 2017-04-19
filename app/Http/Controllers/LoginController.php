<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    function login(Request $request){
        Log::info("LOGIN");
        $user = [
            'email' => $request->email,
            'password'  =>  $request->password
        ];
        $data = json_encode($user);
        //dd($data);
        /*Send Request to Server*/
        $client = new Client();
        $req = $client->request('POST', 'http://localhost:8000/login', array(
            'headers' => array('Content-type' =>'application/json'),
            'body'  => $data
        ));
        Log::info("GET BODY");
        $response = $req->getBody();
        $data = json_decode($response);
        $message = $data->message;
        return Redirect::to(($message->status == "OK")?'/':'/login')->with('message', $message->description);
    }
}
