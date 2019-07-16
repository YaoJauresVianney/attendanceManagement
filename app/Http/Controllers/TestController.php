<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function hello()
    {
        $datas = request()->all();
        if(isset($datas['age']) && $datas['age'] < 1){
            return 'You are so young !!!';
        }
        return 'Hello ' . ucfirst($datas['nom']) . ' ' . $datas['prenom'] . ', you are ' . $datas['age'];
    }

    public function hello2($nom, $prenoms)
    {
        return 'Hello ' . ucfirst($nom) . ' ' . ucfirst($prenoms);
    }
}
