<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Doctor extends Model
{
    //

    protected $guarded = []; 

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->uid = (string) Str::uuid();
        });

        static::deleting(function($model){
            if($model->img && Storage::exists($model->img)){
                 Storage::delete($model->img);
            }
        });

    }

   


    
}
