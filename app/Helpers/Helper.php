<?php

namespace App\Helpers;

use App\Models\Guest;
use App\Models\Position;

class Helper
{
    public static function getDaftarJabatan()
    {
        $accounts = Position::select('id','name')
                    ->where('status','!=',1)
                    ->get();

        $akun_array=[];
        foreach ($accounts as $model){
            $akun_array[$model->id] = $model->name ;
        }        

        return $akun_array;
    }
}