<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'dob',
        'gender',
        'address',
        'first_release_year',
        'no_of_album_released',
    ];
}
