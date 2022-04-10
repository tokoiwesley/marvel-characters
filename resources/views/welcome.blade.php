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
        <h1 class="text-center">Marvel Characters</h1>
    </header>

    <main class="content mt-5 mb-3">
        <div class="row">
            @if($characters->isEmpty())
                <p class="text-center">There are no characters to display!</p>
            @else
                @foreach($characters as $character)
                    @if($loop->index < 4)
                        <div class="col-sm">
                            <a href="{{ route('characters.show', ['id' => $character->unique_id]) }}">
                                <img
                                    src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                                    alt="{{ $character->name }} image"
                                    class="img-fluid img-thumbnail mx-auto d-block"
                                    width="250" height="315">
                                <p class="text-center">{{ $character->name }}</p>
                            </a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 4 and $loop->index < 8)
                    <div class="col-sm">
                        <a href="{{ route('characters.show', ['id' => $character->unique_id]) }}">
                            <img
                                src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                                alt="{{ $character->name }} image"
                                class="img-fluid img-thumbnail mx-auto d-block"
                                width="250" height="315">
                            <p class="text-center">{{ $character->name }}</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 8 and $loop->index < 12)
                    <div class="col-sm">
                        <a href="{{ route('characters.show', ['id' => $character->unique_id]) }}">
                            <img
                                src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                                alt="{{ $character->name }} image"
                                class="img-fluid img-thumbnail mx-auto d-block"
                                width="250" height="315">
                            <p class="text-center">{{ $character->name }}</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 12 and $loop->index < 16)
                    <div class="col-sm">
                        <a href="{{ route('characters.show', ['id' => $character->unique_id]) }}">
                            <img
                                src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                                alt="{{ $character->name }} image"
                                class="img-fluid img-thumbnail mx-auto d-block"
                                width="250" height="315">
                            <p class="text-center">{{ $character->name }}</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 16)
                    <div class="col-sm">
                        <a href="{{ route('characters.show', ['id' => $character->unique_id]) }}">
                            <img
                                src="{{ $character->thumbnail['path'] .".". $character->thumbnail['extension'] . "?{$marvel->getClientSideParams()}" }}"
                                alt="{{ $character->name }} image"
                                class="img-fluid img-thumbnail mx-auto d-block"
                                width="250" height="315">
                            <p class="text-center">{{ $character->name }}</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </main>

    <footer class="">
        <div class="text-center">
            <p>Page {{ $characters->currentPage() }} of {{ $characters->lastPage() }}.
                Displaying {{ $characters->count() }} characters.
                Total characters: {{ $characters->total() }}</p>
        </div>
        <div class="d-flex justify-content-center">
            {{ $characters->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="text-center mt-3 mb-5">
            <small>Data provided by Marvel. © 2014 Marvel</small>
        </div>
    </footer>
</div>
</body>
</html>
