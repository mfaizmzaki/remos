@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@if(session('user_is_switched'))
<div class="alert alert-warning">
    You are currently logged in as a different user. <a href="{{ route('user.restore') }}">Click here</a> to restore your login.
</div>
@endif
<p>Welcome to this beautiful admin panel.</p>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop