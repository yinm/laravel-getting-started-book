<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
    public function index()
    {
        $data = [
            'data' => [
                'one',
                'two',
                'three',
                'four',
                'five'
            ]
        ];
        return view('hello.index', $data);
    }

    public function post(Request $request)
    {
        $data = [
            'msg' => $request->msg
        ];
        return view('hello.index', $data);
    }
}
