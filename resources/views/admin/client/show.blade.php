@extends('adminlte::page')

@section('title', $client->full_name)

@section('body')


    <div class="animated fadeIn">

        <div class="card">
            <div class="card-header">
                <i class="fa fa-user-circle"></i>
                {{$client->full_name}}
                <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                   href="{{ url('admin/clients/'.$client->id.'/edit') }}" role="button">
                    <i class="fa fa-pencil"></i>
                    Редактировать
                </a>
            </div>

            <div class="card-body">
                <table class="table">
                    <tbody>

                    <tr>
                        <th>Телефон</th>
                        <td>{{$client->phone}}</td>
                    </tr>

                    <tr>
                        <th>Фамилия</th>
                        <td>{{$client->surname}}</td>
                    </tr>
                    <tr>
                        <th>Имя</th>
                        <td>{{$client->name}}</td>
                    </tr>

                    <tr>
                        <th>Отчество</th>
                        <td>{{$client->second_name}}</td>
                    </tr>
                    <tr>
                        <th>ИНН</th>
                        <td>{{$client->tin}}</td>
                    </tr>

                    <tr>
                        <th>Серия паспорта</th>
                        <td>{{$client->passport}}</td>
                    </tr>
                    <tr>
                        <th>Прописка</th>
                        <td>{{$client->address}}</td>
                    </tr>

                    <tr>
                        <th>Дата рождения</th>
                        <td>{{$client->date_of_birth}}</td>
                    </tr>

                    <tr>
                        <th>Создан</th>
                        <td>{{$client->created_at}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fa fa-vcard"></i>

            Приемы клиента
        </div>

        <div class="card-body">
            <table class="table">

                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Категория</th>
                    <th>Статус</th>
                    <th>Коммент</th>
                    <th>Пользователь</th>
                    <th></th>
                </tr>


                <tbody>

                @foreach($client->tickets as $ticket)

                    <tr>
                        <td>
                            {{$ticket->created_at? $ticket->created_at:"Нет данных"}}
                        </td>
                        <td>
                            <i class="fa fa-circle text-{{$ticket->category->color}}"></i>
                            {{$ticket->category->name}}
                        </td>
                        <td>
                            <i class="fa fa-circle text-{{$ticket->status->color}}"></i>
                            {{$ticket->status->display_name}}
                        </td>
                        <td>{{$ticket->comment!=""?$ticket->comment:"Нет данных"}}</td>

                        <td>
                            {{$ticket->user?$ticket->user->full_name:"Нет Данных"}}
                        </td>

                        <td></td>

                    </tr>
                @endforeach

                </tbody>


            </table>
        </div>
    </div>


@endsection
