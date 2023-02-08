@extends('admin.layout.default')

@section('title', 'Очередь')

@section('body')

    <div class="animated fadeIn">

        <reception :categories="{{$categories}}" text="{{$text}}"> </reception>

        <monitor :monitor="false" :categories="{{$categories}}" > </monitor>

    </div>


@endsection
