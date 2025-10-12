<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class About extends Model
{
    //

    protected $guarded = [];

    protected function about(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => htmlspecialchars_decode($value, ENT_QUOTES),
            set: fn ($value) => htmlspecialchars($value, ENT_QUOTES, 'UTF-8')
        );
    }

    
}
