<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mypage extends Controller
{
    //new function
    public function index() {
        $data = ['host' => $_SERVER['HTTP_HOST'],
                 'agent' => $_SERVER['HTTP_USER_AGENT'],
                 'addr' => $_SERVER['REMOTE_ADDR'],
                 'soft' => $_SERVER['SERVER_SOFTWARE'],
                 'request' => $_SERVER['REQUEST_SCHEME'] ];
        return view('welcome', $data);
    }
}
