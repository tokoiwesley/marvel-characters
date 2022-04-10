<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
@inject('marvel', 'App\Libraries\Marvel')
<div class="container">
    <header class="mt-2">
        <h1 class="text-center">{{ $character->name }}</h1>
    </header>

    <main class="content mt-5 mb-5">
        <div class="row">
            <div class="col-sm-3">
                <img
                    src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                    alt="{{ $character->name }} image"
                    class="img-fluid img-thumbnail mx-auto d-block"
                    width="250" height="315">
                <p class="text-center">{{ $character->name }}</p>
                <p class="text-justified">{{ $character->description }}</p>
            </div>
            <div class="col-9">
                <section></section>
            </div>
        </div>
    </main>

    <footer>
        <div class="text-center">
            <small>Data provided by Marvel. © 2014 Marvel</small>
        </div>
    </footer>
</div>
</body>
</html>
