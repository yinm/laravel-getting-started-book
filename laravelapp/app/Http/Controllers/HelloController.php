<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request)
    {
        $items = DB::table('people')->get();
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

    public function edit(Request $request)
    {
        $params = [
            'id' => $request->id
        ];
        $item = DB::select('select * from people where id = :id', $params);

        return view('hello.edit', ['form' => $item[0]]);
    }

    public function update(Request $request)
    {
        $params = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name = :name, mail = :mail, age = :age where id = :id', $params);

        return redirect('/hello');
    }

    public function del(Request $request)
    {
        $params = [
            'id' => $request->id
        ];
        $item = DB::select('select * from people where id = :id', $params);

        return view('hello.del', ['form' => $item[0]]);
    }

    public function remove(Request $request)
    {
        $params = [
            'id' => $request->id
        ];
        DB::delete('delete from people where id = :id', $params);

        return redirect('/hello');
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $items = DB::table('people')->where('id', '<=', $id)->get();

        return view('hello.show', ['items' => $items]);
    }
}
