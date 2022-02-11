<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    protected $guarded=[];

    public function fromContact(){
        return $this->hasOne(User::class,'id','from');
    }
}
