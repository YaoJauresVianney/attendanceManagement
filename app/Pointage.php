<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    public function agents(){
        return $this->belongsTo('Agent');
    }
}
