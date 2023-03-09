@extends('adminlte::page')

@section('title', __('adminlte::adminlte')['main'])

@section('content_header')
    <h1>{{ __('adminlte::adminlte')['main'] }}</h1>
@stop

@section('content')
<livewire:main
    :totalToday="$totalToday"
    :categories="$categories"
    :users="$users"
    :alltotal="$alltotal"
    :ticketsByCategory="$ticketsByCategory"
    :ticketsByDate="$ticketsByDate"
    :m="$m"
    :y="$y"
/>
@stop

