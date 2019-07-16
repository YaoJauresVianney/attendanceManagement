<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public function services(){
        return $this->belongsTo('Service');
    }
    public function pointages(){
        return $this->hasMany('Pointage');
    }
}
