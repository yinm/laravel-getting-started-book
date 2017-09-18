<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $params = [
                'id' => $request->id
            ];
            $items = DB::select('select * from people where id = :id', $params);
        } else {
            $items = DB::select('select * from people');
        }

        return view('hello.index', ['items' => $items]);
    }

    public function post(Request $request)
    {
        $rules = [
            'name' => 'required',
            'mail' => 'email',
            'age'  => 'numeric|between:0, 150'
        ];
        $messages = [
            'name.required' => '名前は必ず入力してください。',
            'mail.email' => 'メールアドレスが必要です。',
            'age.numeric' => '年齢を整数で記入ください。',
            'age.between' => '年齢は0 ~ 150の間で入力ください。'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/hello')
                            ->withErrors($validator)
                            ->withInput();
        }

        return view('hello.index', ['msg' => '正しく入力されました！']);
    }

    public function add(Request $request)
    {
        return view('hello.add');
    }

    public function create(Request $request)
    {
        $params = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];

        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $params);
        return redirect('/hello');
    }
}
