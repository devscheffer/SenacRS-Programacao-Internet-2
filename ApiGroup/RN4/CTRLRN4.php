<?php

include_once(__DIR__.'\objRN4.php');
include_once(__DIR__.'\DAORN4.php');

class RN4Controller {

    public function list($request, $response, $args){
        $dao= new RN4DAO;    
        $RN4 = $dao->list();

        return $response->withJSON($RN4);
    
    }

    public function SearchByvendedor($request, $response, $args) {
        $vendedor = $args['vendedor'];
    
        $dao= new RN4DAO;    
        $RN4 = $dao->SearchByvendedor($vendedor);
        
        return $response->withJson($RN4);
    }
    
    public function SearchByano($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN4DAO;    
        $RN4 = $dao->SearchByano($ano);
        
        return $response->withJson($RN4);
    }

    public function SearchByanomes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN4DAO;    
        $RN4 = $dao->SearchByanomes($ano,$mes);
        
        return $response->withJson($RN4);
    }
}
?>
