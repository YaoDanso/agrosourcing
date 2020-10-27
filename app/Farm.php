<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = ['id','longitude','latitude','crop_id','user_id','size','price','image','region_id','quantity','currency','district_id'];

    public function crop(){
        return $this->belongsTo(Crop::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
