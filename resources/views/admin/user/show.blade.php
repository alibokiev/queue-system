@extends('admin.layout.default')

@section('title', ''. $user->first_name)

@section('body')


        <div class="animated fadeIn">

            <div class="card">
                <div class="card-header">
                    {{$user->full_name}}
                    <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                       href="{{ url('admin/admin-users/'.$user->id.'/edit') }}" role="button">
                        <i class="fa fa-pencil"></i>
                        Редактировать
                    </a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Фамилия</th>
                            <td>{{$user->first_name}}</td>
                        </tr>
                        <tr>
                            <th>Имя</th>
                            <td>{{$user->last_name}}</td>
                        </tr>

                        <tr>
                            <th>Имя</th>
                            <td>{{$user->last_name}}</td>
                        </tr>
                        <tr>
                            <th>EMail</th>
                            <td>{{$user->email}}</td>
                        </tr>

                        <tr>
                            <th>Категория</th>
                            <td>{{$user->category?$user->category->name:'Нет'}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>


                <div class="card-header">
                    Cтатистика
                    <form class="form-inline pull-right">
                        <select name="m" id="m" class="form-control-sm  mb-2">
                            <option {{$m==1?'selected':''}} value="01">Янв</option>
                            <option {{$m==2?'selected':''}} value="02">Фев</option>
                            <option {{$m==3?'selected':''}} value="03">Мар</option>
                            <option {{$m==4?'selected':''}} value="04">Апр</option>
                            <option {{$m==5?'selected':''}} value="05">Май</option>
                            <option {{$m==6?'selected':''}} value="06">Июн</option>
                            <option {{$m==7?'selected':''}} value="07">Июл</option>
                            <option {{$m==8?'selected':''}} value="08">Авг</option>
                            <option {{$m==9?'selected':''}} value="09">Сен</option>
                            <option {{$m==10?'selected':''}} value="10">Окт</option>
                            <option {{$m==11?'selected':''}} value="11">Ноя</option>
                            <option {{$m==12?'selected':''}} value="12">Дек</option>
                        </select>

                        <select name="y" id="y" class="form-control-sm  mb-2 ml-2 mr-2" value="{{$y}}">
                            <option {{$y==2019?'selected':''}} value="2019">2019</option>
                            <option {{$y==2020?'selected':''}} value="2020">2020</option>
                            <option {{$y==2021?'selected':''}} value="2021">2021</option>
                            <option {{$y==2022?'selected':''}} value="2022">2022</option>
                            <option {{$y==2023?'selected':''}} value="2023">2023</option>
                            <option {{$y==2024?'selected':''}} value="2024">2024</option>
                        </select>

                        <button type="submit" class="btn btn-sm btn-primary mb-2">Показать</button>
                    </form>


                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Всего сегодня</small>
                                        <br>
                                        <strong class="h4">{{$totalToday}}</strong>
                                        <div class="chart-wrapper">
                                            <canvas id="sparkline-chart-1" width="100" height="30"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->

                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            <hr class="mt-0">
                            @foreach($ticketsByDate as $date => $value)
                                @php
                                    $ttotal = 0;
                                    foreach ($value as $item) {
                                        $ttotal += $item->tickets;
                                    }
                                @endphp
                                <div class="progress-group mb-4">
                                    <div class="progress-group-prepend">
                                        <span class="progress-group-text">{{Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d.m.Y')}}</span>
                                    </div>
                                    <div class="progress-group-bars">
                                        @foreach($value as $item)
                                            <div class="font-weight-bold mr-2">
                                                <small>{{$item->category->name}}:</small>
                                                {{$item->tickets}}
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-{{$item->category->color}}"
                                                     role="progressbar"
                                                     style="width: {{round(100 / $ttotal  * $item->tickets ,0)}}%"
                                                     aria-valuenow="{{round(100 / $ttotal  * $item->tickets ,0)}}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6">
                            <div class="row">

                                <!-- /.col-->
                                <div class="col-sm-6">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Всего</small>
                                        <br>
                                        <strong class="h4">{{$total}}</strong>
                                        <div class="chart-wrapper">
                                            <canvas id="sparkline-chart-4" width="100" height="30"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            <hr class="mt-0">




                        </div>
                        <!-- /.col-->
                    </div>
                    <!-- /.row-->
                    <br>

                </div>

            </div>
        </div>


@endsection