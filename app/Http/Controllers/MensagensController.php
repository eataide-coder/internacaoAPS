<?php

namespace App\Http\Controllers;

require_once "Util.php";

use App\Controller\Util;
use App\Models\DAOmensagens;
use Illuminate\Http\Request;

define('respostaregulacao', 1);
define('respostaUnidade', 2);
define('avaliacaoParecer', 4);
define('cnesComplexoRegulador', 7106513);

class MensagensController extends Controller
{
    public function getMensagens(){

    $result =  DAOmensagens::mensagens();

    $msg = '';

    return($result[0]->id > 0 ? Util::jsonResultTrue($msg, $result) : Util::jsonResultFalse());

    }

    public function insertMensagens(Request $request){

        $cnesComplexoRegulador 			= "7106513";
        $cnes_usuario_logado 			= $request['cnes'];
        $id_aps 						= $request['id_aps'];

        $status_id = DAOmensagens::getStatus($request);

            if ($status_id == avaliacaoParecer) 
            {
                $status_id = avaliacaoParecer;

            } elseif ($cnes_usuario_logado == cnesComplexoRegulador)
            {

                $status_id = respostaUnidade;

            } else 
            {

                $status_id = respostaregulacao;
            }

        $id_aps = $request['id_aps'];
        $result = DAOmensagens::getApsId($id_aps);

        DAOmensagens::updateStatus($id_aps, $status_id);
        DAOmensagens::insertMensagens($request);
        

        return Util::jsonInsertTrue($result);
        
        }
}
