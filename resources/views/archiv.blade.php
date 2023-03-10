<?php
{{--@if ($errors->any())--}}
{{--    <div class="btn-group mb-3 w-100">--}}
{{--        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
{{--            Other errors :(--}}
{{--        </button>--}}
{{--        <div class="dropdown-menu">--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <a class="dropdown-item" href="#">{{ $error }}</a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}


{{--<div id="app">--}}
{{--    <main class="main">--}}
{{--        <div class="container" id="app" :class="{'loading': loading}" style="margin-top: 1.5rem">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card">--}}
{{--                        <table class="table ">--}}
{{--                            <thead class="thead-light">--}}
{{--                            <tr>--}}
{{--                                <th><h2>Навбат</h2></th>--}}
{{--                                <th></th>--}}
{{--                                <th class="text-center"><h2>Қабул</h2></th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                            <tr>--}}
{{--                                <td class="no-borders" style="width: 30%">--}}
{{--                                    <p class="h4">--}}
{{--                                        @foreach($user->tickets as $index => $ticket)--}}
{{--                                            <span>--}}
{{--                                            @if($ticket->status_id === 1)--}}
{{--                                                    <span>--}}
{{--                                                    @if($index < 8)--}}
{{--                                                            <span>--}}
{{--                                                                {{ $ticket->number }}--}}
{{--                                                            @if(count($user->tickets) > 1 && $index < 7)--}}
{{--                                                                    <span>--}}
{{--                                                                    @if($index < (count($user->tickets) - 1))--}}
{{--                                                                            <span>,</span>--}}
{{--                                                                        @endif--}}
{{--                                                                </span>--}}
{{--                                                                @endif--}}
{{--                                                        </span>--}}
{{--                                                        @endif--}}
{{--                                                    @if($index === 8)--}}
{{--                                                            <span>...</span>--}}
{{--                                                        @endif--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                        @endforeach--}}
{{--                                    </p>--}}
{{--                                </td>--}}
{{--                                <td class="{{ 'no-borders table-' . $user->category->color }}">--}}
{{--                                    <h5>{{ $user->category->name }}</h5>--}}
{{--                                    <h4>{{ $user->full_name }} </h4>--}}
{{--                                </td>--}}
{{--                                <td class="no-borders text-center" style="width: 15%">--}}
{{--                                    <h1 class="pulse">--}}
{{--                                    @foreach($user->tickets as $index => $ticket)--}}
{{--                                            <span>--}}
{{--                                            @if($ticket->status_id === 2)--}}
{{--                                                    <span>--}}
{{--                                                        {{ $ticket->number }}--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                        @endforeach--}}
{{--                                    </h1>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--</div>--}}
