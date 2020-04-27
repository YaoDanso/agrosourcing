<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','price','materials',
        'business','region','longitude','latitude','wastes','user_id','image'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
