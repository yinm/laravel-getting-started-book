<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;

class HelloController extends Controller
{
    public function index()
    {
        return view('hello.index', ['msg' => 'フォームを入力:']);
    }

    public function post(HelloRequest $request)
    {
        return view('hello.index', ['msg' => '正しく入力されました！']);
    }
}
