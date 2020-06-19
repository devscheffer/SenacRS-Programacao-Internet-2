<?php

include_once(__DIR__.'\objRN3.php');
include_once(__DIR__.'\DAORN3.php');

class RN3Controller {

    public function list($request, $response, $args){
        $dao= new RN3DAO;    
        $RN3 = $dao->list();

        return $response->withJSON($RN3);
    
    }

    public function SearchByconcessionaria($request, $response, $args) {
        $concessionaria = $args['concessionaria'];
    
        $dao= new RN3DAO;    
        $RN3 = $dao->SearchByconcessionaria($concessionaria);
        
        return $response->withJson($RN3);
    }
    
    public function SearchByano($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN3DAO;    
        $RN3 = $dao->SearchByano($ano);
        
        return $response->withJson($RN3);
    }

    public function SearchByanomes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN3DAO;    
        $RN3 = $dao->SearchByanomes($ano,$mes);
        
        return $response->withJson($RN3);
    }
}
?>
