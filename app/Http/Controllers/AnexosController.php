<?php

namespace App\Http\Controllers;

require_once "Util.php";

use App\Controller\Util;
use App\Models\DAOanexos;
use Illuminate\Http\Request;

class AnexosController extends Controller
{
    public function upload_files(){

        $result = DAOanexos::upload_files();

        return $result == true ? Util::jsonInsertTrue($result = []) : Util::jsonInsertFalse();
    }
}
