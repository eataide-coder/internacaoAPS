<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DAOmensagens extends Model
{
    use HasFactory;
    protected $table = "tb_mensagens";

    public static function mensagens(){

        $sql = "SELECT * FROM tb_mensagens";
        return DB::select($sql);
    }

    public static function insertMensagens($dados){

        $sql = DB::table('tb_mensagens')->insert([
            'id_aps' => $dados['id_aps'],
            'msg' => $dados['msg'],
            'nome' => $dados['nome'],
            'unidade'=> $dados['unidade'],
            'usuario' => $dados['usuario']
        ]);

        if($sql){
            return true;
        }
        return false;
    }

    public static function updateStatus($id_aps, $status_id){

        DB::table('tb_aps')
        ->where('id', $id_aps)
        ->update(['status_id' => $status_id]);
    }

    public static function getStatus($id_aps){

        $id_aps = $id_aps['id_aps'];

       $status_id = DB::table('tb_aps')
        ->where('id', $id_aps)
        ->select('status_id')
        ->get();

        return $status_id[0]->status_id;
    }

    public static function getApsId($id_aps){
        
        return DB::table('tb_aps')->where('id', $id_aps)->get();
    }
    public function aps(): BelongsTo {

        return $this->belongsTo(DAOaps::class, 'id_aps', 'id');
    }
}
