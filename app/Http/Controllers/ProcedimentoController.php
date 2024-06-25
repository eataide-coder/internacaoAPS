<?php

namespace App\Http\Controllers;

require_once "Util.php";

use App\Models\DAOProcedimento;
use Illuminate\Http\Request;
use App\Controller\Util;

class ProcedimentoController extends Controller
{
    public function getProcedimentos(){

        $result = DAOProcedimento::getProcedimentos();
        $msg = '';

        return $result != [] ? Util::jsonResultTrue($msg, $result) : Util::jsonResultFalse();
    }
}
