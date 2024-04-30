<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DAOaps extends Model
{
    use HasFactory;
    protected $table = "tb_aps";

    public static function getDadosCr(){

        return DB::table('tb_aps')
                ->join('tb_status', 'tb_status.id', '=', 'tb_aps.status_id')
                ->select('tb_aps.*', 'tb_status.status')
                ->get();        
    }

    public static function getDadosAps($cnes){

        return DB::table('tb_aps')
                ->join('tb_status', 'tb_status.id', '=', 'tb_aps.status_id')
                ->select('tb_aps.*', 'tb_status.status')
                ->where('tb_aps.cnes','=', $cnes)
                ->get();        
    }

    public static function getDadosCap($cap){

        return DB::table('tb_aps')
                ->join('subpav_principal.unidades', 'tb_aps.cnes', '=', 'subpav_principal.unidades.COD_UB')
                ->select('tb_aps.*', 'subpav_principal.unidades.TIPO_UNID')
                ->where('subpav_principal.unidades.DIST_SANIT','=', $cap)
                ->get();        
    }
}