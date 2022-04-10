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
            <div class="col-md-3">
                <img
                    src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                    alt="{{ $character->name }} image"
                    class="img-fluid img-thumbnail mx-auto d-block"
                    width="250" height="315">
                <p class="text-center">{{ $character->name }}</p>
                <h2 class="text-center">Description</h2>
                @if($character->description)
                    <p class="text-start">{{ $character->description }}</p>
                @else
                    <p class="text-center">Description not found!</p>
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <section class="comics col-md-6">
                        <h2 class="text-start mt-2 mb-2">Comics</h2>
                        <ol class="list-group list-group-numbered">
                            @if($character->comics['items'])
                                @foreach($character->comics['items'] as $item)
                                    <li class="list-group-item list-group-item-action">{{ $item['name'] }}</li>
                                @endforeach
                            @else
                                <p class="text-start">Comics not found!</p>
                            @endif
                        </ol>
                    </section>
                    <section class="series col-md-6">
                        <h2 class="text-start mt-2 mb-2">Series</h2>
                        <ol class="list-group list-group-numbered">
                            @if($character->series['items'])
                                @foreach($character->series['items'] as $item)
                                    <li class="list-group-item list-group-item-action">{{ $item['name'] }}</li>
                                @endforeach
                            @else
                                <p class="text-start">Series not found!</p>
                            @endif
                        </ol>
                    </section>
                </div>
                <div class="row">
                    <section class="stories col-md-12">
                        <h2 class="text-start mt-2 mb-2">Stories</h2>
                        <ol class="list-group list-group-numbered">
                            @if($character->stories['items'])
                                @foreach($character->stories['items'] as $item)
                                    <li class="list-group-item list-group-item-action">{{ $item['name'] }}</li>
                                @endforeach
                            @else
                                <p class="text-start">Stories not found!</p>
                            @endif
                        </ol>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <footer class="mb-5">
        <div class="text-center">
            <small>Data provided by Marvel. © 2014 Marvel</small>
        </div>
    </footer>
</div>
</body>
</html>
