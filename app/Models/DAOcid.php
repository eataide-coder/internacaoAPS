<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DAOcid extends Model
{
    use HasFactory;
    protected $table = "sigtap.tb_cid";

    public static function getCidprocedimento($CO_PROCEDIMENTO){

        $getCidProc =  DB::table('sigtap.tb_cid')
                ->leftJoin('sigtap.rl_procedimento_cid', 'sigtap.tb_cid.CO_CID','=', 'sigtap.rl_procedimento_cid.CO_CID')
                ->leftJoin('sigtap.tb_procedimento', 'sigtap.tb_procedimento.CO_PROCEDIMENTO','=','sigtap.rl_procedimento_cid.CO_PROCEDIMENTO')
                ->select('sigtap.tb_cid.CO_CID', 'sigtap.tb_cid.NO_CID')
                ->where('sigtap.tb_procedimento.CO_PROCEDIMENTO','=', $CO_PROCEDIMENTO)
                ->groupBy(DB::raw('sigtap.tb_cid.CO_CID'))->get();
                
        return $getCidProc;
    }
    public static function getCid(){

        return DB::table('sigtap.tb_cid AS cid')
                    ->select('cid.ID', 'cid.CO_CID','cid.NO_CID')
                    ->get();
    }
}
