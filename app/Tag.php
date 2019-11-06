<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const TYPES = 
    [
        1 => 'Priedas Būtinas',
        2 => 'Priedas Nebūtinas',
        3 => 'Nuolaida'
    ];
}
