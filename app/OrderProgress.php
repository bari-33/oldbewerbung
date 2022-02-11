<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProgress extends Model
{
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
