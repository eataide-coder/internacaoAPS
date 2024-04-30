<?php

namespace App\Http\Controllers;

require_once "Util.php";

use App\Controller\Util;
use App\Models\DAOaps;
use App\Models\DAOanexos;
use Illuminate\Http\Request;

define('cnesComplexoRegulador', 7106513);
define('cnesSMS', 5462886);
define('tipoUnidade', 7);

class ApsController extends Controller
{
    public function listar_aps(Request $request){

        $cnes = $request['cnes'];
        $cap = $request['cap'];
        $tipoUnidade = $request['tipo_unidade'];

        if($cnes == cnesSMS || $cnes == cnesComplexoRegulador){
            $msg = 'CR ou SMS';
            $result = DAOaps::getDadosCr(); // CR ou SMS

        }else{ 
        
            if($tipoUnidade != tipoUnidade){
                $msg = 'APS';
                $result = DAOaps::getDadosAps($cnes); // APs

            }else{
                $msg = 'CAP';
                $result = DAOaps::getDadosCap($cap); // CAP
            }
        }

        return Util::jsonResultTrue($msg, $result);
    }

    public function getDadosId(Request $request){

        $id_aps = $request['id_aps'];
        $result = DAOaps::getDadosId($id_aps)->with('anexos', 'mensagens')->get();
        $msg = '';

        return Util::jsonResultTrue($msg, $result);
    }
}
