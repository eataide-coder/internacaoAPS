<?php

namespace App\Controller;

    class Util
    {
        public static function jsonResultTrue($msg, $result){

            return(array("status" => "true", "msg" => $msg, "data" => $result));
        }

        public static function jsonResultFalse(){

            return(array("status" => "false", "msg" => " ", "data" => []));
        }

        public static function jsonInsertTrue($result){

            return(array("status" => "true", "msg" => " Dados inseridos com sucesso!", "data" => $result));
        }

        public static function jsonInsertFalse($result){

            return(array("status" => "false", "msg" => "Não foi possível inserir os dados!", "data" => []));
        }
    }