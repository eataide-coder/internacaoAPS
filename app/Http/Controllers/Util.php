<?php

namespace App\Controller;

use Illuminate\Support\Facades\DB;

    class Util
    {
        public static function jsonResultTrue($msg, $result){

            return(array("status" => "true", "msg" => $msg, "data" => $result));
        }

        public static function jsonResultFalse(){

            return(array("status" => "false", "msg" => " ", "data" => []));
        }

        public static function jsonInsertTrue(){

            return(array("status" => "true", "msg" => " Dados inseridos com sucesso!"));
        }

        public static function jsonInsertFalse(){

            return(array("status" => "false", "msg" => "Não foi possível inserir os dados!", "data" => []));
        }
        public static function jsonUpdateTrue(){

            return(array("status" => "false", "msg" => "Não foi possível atualizar os dados!", "data" => []));
        }
        public static function jsonUpdateFalse(){

            return(array("status" => "false", "msg" => "Dados alterados!", "data" => []));
        }  
    }