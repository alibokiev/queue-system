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
        .app {
            background-color: {{ config('monitor.body.background-color') }};
            {{ config('monitor.other-styles') }}
        }
    </style>

</head>
<body class="app">

<div class="container-fluid">
    <div class="row">
        @foreach(config('monitor.columns') as $column)
            @if($column['enable'])
                <div class="column col">
                    <div class="content-header border-0 bg-gradient-dark">
                        <h1 class="text-dark">{{ $column['title'] }}</h1>
                    </div>
                    @livewire('board' ['tickets' => $tickets])
                </div>
            @endif
        @endforeach
    </div>
</div>

</body>

<footer>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script>
        Echo.channel('board')
            .listen('QueueProcessed', (e) => {
                console.log(e.order.name);
            });
    </script>
    @vite(['resources/js/app.js'])
</footer>
</html>
