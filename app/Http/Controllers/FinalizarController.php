<?php

namespace App\Http\Controllers;

require_once "Util.php";

use Illuminate\Http\Request;
use App\Models\DAOfinalizar;
use App\Controller\Util;

class FinalizarController extends Controller
{
    public function opcoes_finalizar(){
        $result = DAOFinalizar::getOpcoesFinalizar();
        $msg = '';

        return Util::jsonResultTrue($msg, $result);
    }
}
