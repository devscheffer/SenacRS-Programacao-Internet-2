<?php

include_once(__DIR__.'\..\OBJ\objRN3.php');
include_once(__DIR__.'\..\DAO\DAORN3.php');

class RN3Controller {

    public function list($request, $response, $args){
        $dao= new RN3DAO;    
        $RN3 = $dao->list();

        return $response->withJSON($RN3);
    
    }

    public function SearchByVendedor($request, $response, $args) {
        $vendedor = $args['vendedor'];
    
        $dao= new RN3DAO;    
        $RN3 = $dao->SearchByVendedor($vendedor);
        
        return $response->withJson($RN3);
    }
    
    public function SearchByAno($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN3DAO;    
        $RN3 = $dao->SearchByAno($ano);
        
        return $response->withJson($RN3);
    }

    public function SearchByAnoMes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN3DAO;    
        $RN3 = $dao->SearchByAnoMes($ano,$mes);
        
        return $response->withJson($RN3);
    }
}
?>
