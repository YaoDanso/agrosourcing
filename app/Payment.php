<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "tables";

    protected $fillable = ['method','status','order_id'];
}
