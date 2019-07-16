<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousDirection extends Model
{
    public function services(){
        return $this->hasMany('Service');
    }
    
}
