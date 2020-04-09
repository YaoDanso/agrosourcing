<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $fillable = ['id','name'];

    public function farm(){
        return $this->belongsToMany(Farm::class);
    }

    public function wastes(){
        return $this->hasMany(Waste::class);
    }
}
