<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index()
    {
        $items = DB::table('people')->orderBy('age', 'asc')->get();
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

        DB::table('people')->insert($params);
        return redirect('/hello');
    }

    public function edit(Request $request)
    {
        $item = DB::table('people')
                  ->where('id', $request->id)
                  ->first();

        return view('hello.edit', ['form' => $item]);
    }

    public function update(Request $request)
    {
        $params = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')
          ->where('id', $request->id)
          ->update($params);

        return redirect('/hello');
    }

    public function del(Request $request)
    {
        $item = DB::table('people')
                  ->where('id', $request->id)
                  ->first();

        return view('hello.del', ['form' => $item]);
    }

    public function remove(Request $request)
    {
        DB::table('people')
          ->where('id', $request->id)
          ->delete();

        return redirect('/hello');
    }

    public function show(Request $request)
    {
        $page = $request->page;
        $items = DB::table('people')
                   ->offset($page * 3)
                   ->limit(3)
                   ->get();

        return view('hello.show', ['items' => $items]);
    }
}
