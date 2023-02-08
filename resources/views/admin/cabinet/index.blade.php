@extends('admin.layout.default')

@section('title', 'Личный кабинет')

@section('body')

    <div class="animated fadeIn">

        <div class="card">
            <div class="card-header">
                <i class="icon-briefcase"></i>
                {{--                <i class="icon-feed"></i>--}}
                {{--                <i class="icon-action-redo"></i>--}}
                {{$user->category->name}}
                {{--                ---}}
                {{--                <i class="icon-user-following"></i>--}}
                {{--                <i class="icon-ban"></i>--}}
                {{--                {{$user->full_name}}--}}
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
