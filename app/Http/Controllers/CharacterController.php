<?php

namespace App\Http\Controllers;

use App\Jobs\FetchMarvelCharacters;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::paginate(20);
        return view('welcome', ['characters' => $characters]);
    }

    public function show(int $unique_id)
    {
        $character = cache()->remember("$unique_id", 3600, function () use (&$unique_id) {
            return Character::where('unique_id', $unique_id)->firstOrFail();
        });

        return view('show', ['character' => $character]);
    }
}
