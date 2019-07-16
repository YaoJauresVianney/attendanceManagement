<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function sousDirections()
    {
        return $this->belongsTo('SousDirection');
    }
    public function agents(){
        return $this->hasMany('Agent');
    }
}
