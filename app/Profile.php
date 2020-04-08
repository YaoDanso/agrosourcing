<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['pic','bio','company','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
