<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Очередь</title>

    @vite(['resources/sass/app.scss'])

    <style>
        html {
            font-size: {{$size}}px;
        }
        .pulse {
            animation: pulse 1.5s ease infinite;
            /*transition: transform 0.2s;*/
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .rotated {
            transform: rotate(-90deg);
        }
    </style>

</head>

<body class="app">
<div id="app">
    <main class="main">
        <div class="container" id="app" :class="{'loading': loading}" style="margin-top: 1.5rem">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="table ">
                            <thead class="thead-light">
                            <tr>
                                <th><h2>Навбат</h2></th>
                                <th></th>
                                <th class="text-center"><h2>Қабул</h2></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="no-borders" style="width: 30%">
                                    <p class="h4">
                                        @foreach($user->tickets as $index => $ticket)
                                            <span>
                                                @if($ticket->status_id === 1)
                                                    <span>
                                                        @if($index < 8)
                                                        <span>
                                                            {{ $ticket->number }}
                                                            @if(count($user->tickets) > 1 && $index < 7)
                                                                <span>
                                                                    @if($index < (count($user->tickets) - 1))
                                                                        <span>,</span>
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        </span>
                                                        @endif
                                                        @if($index === 8)
                                                            <span>...</span>
                                                        @endif
                                                    </span>
                                                @endif
                                            </span>
                                        @endforeach
                                    </p>
                                </td>

                                <td class="{{ 'no-borders table-' . $user->category->color }}">
                                    <h5>{{ $user->category->name }}</h5>
                                    <h4>{{ $user->full_name }} </h4>
                                </td>

                                <td class="no-borders text-center" style="width: 15%">
                                    <h1 class="pulse">
                                        @foreach($user->tickets as $index => $ticket)
                                            <span>
                                                @if($ticket->status_id === 2)
                                                <span>
                                                    {{ $ticket->number }}
                                                </span>
                                                @endif
                                            </span>
                                        @endforeach
                                    </h1>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </main>
</div>

<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
@vite(['resources/js/app.js'])
</body>

</html>
