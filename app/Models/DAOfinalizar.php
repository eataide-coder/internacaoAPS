<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DAOfinalizar extends Model
{
    use HasFactory;
    protected $table = 'tb_finalizacao_aps';

    public static function getOpcoesFinalizar(){
        return DB::table('tb_finalizacao_aps')->get();
    }
}
