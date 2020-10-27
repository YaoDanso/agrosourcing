<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name', 'region_id'
    ];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'id', 'regions');
    }
}
