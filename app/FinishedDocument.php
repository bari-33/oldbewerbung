<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedDocument extends Model
{
    public function order()
    {
        return $this->$this->belongsTo(Order::class);
    }
}
