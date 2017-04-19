<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    function index(){
        $message = Session::get('message');    //get message from session when redirect to this function
        return view('index', compact('message'));
    }
}
