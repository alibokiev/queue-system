@extends('adminlte::page')

@section('title', 'Личный кабинет')

@section('content')

    <div class="animated fadeIn">

        <div class="card">
            <div class="card-header">
                <i class="icon-briefcase"></i>
                {{$user->category->name}}
            </div>
            <div class="card-body">

                @if($user->category_id === null)
                    <div class="no-items-found">
                        <i class="icon-wrench"></i>
                        <h3>У вас не установлена категория </h3>
                    </div>
                @else
                    <cabinet></cabinet>
                @endif
            </div>
        </div>

    </div>


@endsection
