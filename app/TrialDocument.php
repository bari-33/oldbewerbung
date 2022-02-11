<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrialDocument extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
