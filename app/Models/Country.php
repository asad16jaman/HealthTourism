<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //

    protected $guarded = [] ; 


    public function hospitals(){
        return $this->hasMany(Hospital::class);
    }

    public function hashospital(){
        return $this->hospitals()->exists();
    }


}
