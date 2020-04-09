<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = ['id','longitude','latitude','crop_id','user_id','size'];

    public function crop(){
        return $this->belongsTo(Crop::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
