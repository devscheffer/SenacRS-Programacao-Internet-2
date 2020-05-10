<?php

include_once(__DIR__.'\objRN1.php');
include_once(__DIR__.'\DAORN1.php');

class RN1Controller {

    public function list($request, $response, $args){
        $dao= new RN1DAO;    
        $RN1 = $dao->list();

        return $response->withJSON($RN1);
    
    }

    public function SearchByvendedor($request, $response, $args) {
        $vendedor = $args['vendedor'];
    
        $dao= new RN1DAO;    
        $RN1 = $dao->SearchByvendedor($vendedor);
        
        return $response->withJson($RN1);
    }
    
    public function SearchByano($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN1DAO;    
        $RN1 = $dao->SearchByano($ano);
        
        return $response->withJson($RN1);
    }

    public function SearchByanomes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN1DAO;    
        $RN1 = $dao->SearchByanomes($ano,$mes);
        
        return $response->withJson($RN1);
    }
}
?>
