<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['region','latitude','longitude','price','user_id','image'];

    public function crops(){
        return $this->belongsToMany(Crop::class);
    }
}
