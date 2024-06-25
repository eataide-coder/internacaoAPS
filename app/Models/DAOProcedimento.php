<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DAOProcedimento extends Model
{
    use HasFactory;
    protected $table = "sigtap.tb_procedimento";

    public static function getProcedimentos(){
        return DB::table('sigtap.tb_procedimento')
                    ->select('id','CO_PROCEDIMENTO', 'NO_PROCEDIMENTO')
                    ->get();
    }
}
