@extends('layout.main')

@section('seo')
<title>Welcome</title>
@stop

@section('content')

@if(Auth::check())
Welcome, {{ Auth::user()->name }}
@else
You are not logged in.
@endif

@stop