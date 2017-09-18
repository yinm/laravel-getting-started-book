<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }

    public function find()
    {
        return view('person.find', ['input' => '']);
    }

    public function search(Request $request)
    {
        $item = Person::nameEqual($request->input)->first();
        $params = [
            'input' => $request->input,
            'item' => $item,
        ];

        return view('person.find', $params);
    }
}
