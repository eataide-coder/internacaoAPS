<?php

namespace App\Http\Controllers;

require_once "Util.php";

use App\Models\DAOcid;
use App\Controller\Util;
use Illuminate\Http\Request;

class CidController extends Controller
{
    public function listar_cid(Request $request){

        $CO_PROCEDIMENTO = $request['CO_PROCEDIMENTO'];

        $result = $CO_PROCEDIMENTO != '' ? DAOcid::getCidprocedimento($CO_PROCEDIMENTO) : DAOcid::getCid();
        $msg = '';

        return Util::jsonResultTrue($msg, $result);
    }
}
