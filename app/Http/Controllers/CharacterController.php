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
}
