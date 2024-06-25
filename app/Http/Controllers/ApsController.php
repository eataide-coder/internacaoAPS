<?php

namespace App\Http\Controllers;

require_once "Util.php";

use App\Controller\Util;
use App\Models\DAOaps;
use App\Models\DAOanexos;
use App\Models\DAOfinalizar;
use Illuminate\Http\Request;

define('cnesComplexoRegulador', 7106513);
define('cnesSMS', 5462886);
define('tipoUnidade', 7);

class ApsController extends Controller
{
    public function listar_aps(Request $request){

        $cnes           = $request['cnes'];
        $cap            = $request['cap'];
        $tipoUnidade    = $request['tipo_unidade'];

        if($cnes == cnesSMS || $cnes == cnesComplexoRegulador){
            $msg = 'CR ou SMS';
            $result = DAOaps::getDadosCr();

        }else{ 
        
            if($tipoUnidade != tipoUnidade){
                $msg = 'APS';
                $result = DAOaps::getDadosAps($cnes);

            }else{
                $msg = 'CAP';
                $result = DAOaps::getDadosCap($cap);
            }
        }

        return Util::jsonResultTrue($msg, $result);
    }

    public function getDadosId(Request $request){

        $id_aps = $request['id_aps'];
        $result = DAOaps::getDadosId($id_aps);
        $msg = '';

        return Util::jsonResultTrue($msg, $result);
    }
    
    public function update_aps(Request $dados){

        $result = DAOaps::update_aps($dados);
        return $result == true ? Util::jsonUpdateTrue($result = []) : Util::jsonUpdateFalse();
    }

    public function finaliza_aps(Request $dados){

        $result = DAOaps::finaliza_aps($dados);
        return $result == true ? Util::jsonUpdateTrue($result = []) : Util::jsonUpdateFalse();
    }

    public function insert_aps(Request $dados) {
        $result = DAOaps::insertAps($dados);
        $msg = '';

        return($result == true ? Util::jsonInsertTrue() : Util::jsonInsertFalse()) ;
        
    }
}
