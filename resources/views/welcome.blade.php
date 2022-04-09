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
<div class="container">
    @inject('marvel', 'App\Libraries\Marvel')
    <header class="mt-2">
        <h1 class="text-center">Marvel Characters</h1>
    </header>

    <main class="content mt-5 mb-5">

        <div class="row">
            @foreach($characters as $character)
                @if($loop->index < 4)
                    <div class="col-sm">
                        <img src="https://via.placeholder.com/540x614.jpg"
                             alt="{{ $character->name }} - Marvel character's image"
                             class="img-fluid img-thumbnail mx-auto d-block"
                             width="250" height="315">
                        <p class="text-center">{{ $character->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 4 and $loop->index < 8)
                    <div class="col-sm">
                        <img src="https://via.placeholder.com/540x614.jpg"
                             alt="{{ $character->name }} - Marvel character's image"
                             class="img-fluid img-thumbnail mx-auto d-block"
                             width="250" height="315">
                        <p class="text-center">{{ $character->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 8 and $loop->index < 12)
                    <div class="col-sm">
                        <img src="https://via.placeholder.com/540x614.jpg"
                             alt="{{ $character->name }} - Marvel character's image"
                             class="img-fluid img-thumbnail mx-auto d-block"
                             width="250" height="315">
                        <p class="text-center">{{ $character->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 12 and $loop->index < 16)
                    <div class="col-sm">
                        <img src="https://via.placeholder.com/540x614.jpg"
                             alt="{{ $character->name }} - Marvel character's image"
                             class="img-fluid img-thumbnail mx-auto d-block"
                             width="250" height="315">
                        <p class="text-center">{{ $character->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            @foreach($characters as $character)
                @if($loop->index >= 16)
                    <div class="col-sm">
                        <img src="https://via.placeholder.com/540x614.jpg"
                             alt="{{ $character->name }} - Marvel character's image"
                             class="img-fluid img-thumbnail mx-auto d-block"
                             width="250" height="315">
                        <p class="text-center">{{ $character->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </main>

    <footer>
        <div class="text-center">
            <p>Page {{ $characters->currentPage() }} of {{ $characters->lastPage() }}.
                Displaying {{ $characters->count() }} characters.
                Total characters: {{ $characters->total() }}</p>
        </div>
        <div class="d-flex justify-content-center">
            {{ $characters->links('vendor.pagination.bootstrap-4') }}
        </div>
    </footer>
</div>
</body>
</html>
