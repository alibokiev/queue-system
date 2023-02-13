@extends('adminlte::page')

@section('content_header')
    @if(1)
        @yield('content_header')
    @endif

    <h1>Dashboard</h1>
@stop

@yield('body')

@section('title', config('adminlte.title'))

@section('css')
    <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
    @yield('css')
@stop

@section('js')
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('js')
@stop
