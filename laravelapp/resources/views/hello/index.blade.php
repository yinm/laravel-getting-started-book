@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
  <p>ここが本文のコンテンツです。</p>

  <p>これは、<middleware>google.com</middleware>のリンクです。</p>
  <p>これは、<middleware>yahoo.co.jp</middleware>のリンクです。</p>
@endsection

@section('footer')
  copyright 2017 tuyano.
@endsection