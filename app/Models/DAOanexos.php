<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DAOanexos extends Model
{
    use HasFactory;
    protected $table = 'tb_anexos';

    public static function upload_files(){

        $permitidos = ['jpg','jpeg','pdf','png','docx','xlsx','xls', 'doc', 'txt'];
        $nome = $_FILES['anexos']['name'];
        $temp = $_FILES['anexos']['tmp_name'];
        $dir = '../uploads/';
        $id_aps = $_POST['id_aps'];

        if(isset($_FILES['anexos'])){

            for($i = 0; $i < count($nome); $i++){
                $extensao = explode('.', $nome[$i]);
                $extensao = end($extensao);

                if(in_array($extensao, $permitidos)){
                    $fileName = "id_aps_" . $id_aps . "-" . $nome[$i];
        
                    move_uploaded_file($temp[$i], $dir . "id_aps_" . $id_aps . "-" . $nome[$i]);
                    DB::table('tb_anexos')->updateOrInsert([
                    "id_aps" => $id_aps,
                    "anexos" => $fileName
                    ]);
                    }
                }
                return true;
        }
        return false;
    }

    public function anexos(): BelongsTo{

        return $this->belongsTo(DAOaps::class, 'id_aps', 'id');
    }
}
