<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //

    protected $guarded = [];

    public function bookfiles(){
        return $this->hasMany(Bookfile::class);
    }

    public function relations(){
        return $this->hasMany(Relation::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    
    public function files(){
        return $this->hasMany(Bookfile::class);
    }
    

    
}
