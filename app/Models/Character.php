<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'thumbnail' => 'array',
        'comics' => 'array',
        'series' => 'array',
        'stories' => 'array',
        'events' => 'array',
        'urls' => 'array',
    ];
}
