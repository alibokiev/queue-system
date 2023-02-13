<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Очередь</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
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
<div class="app-body">
    <main class="main">
        <div class="container" id="app" :class="{'loading': loading}" style="margin-top: 1.5rem">
            <monitor :monitor="true" :categories="{{$categories}}" :users="{{$users}}"></monitor>
        </div>
    </main>
</div>

<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
