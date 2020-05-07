<?php

include_once(__DIR__.'\..\OBJ\objRN1.php');
include_once(__DIR__.'\..\DAO\DAORN1.php');

class RN1Controller {

    public function list($request, $response, $args){
        $dao= new RN1DAO;    
        $RN1 = $dao->list();

        return $response->withJSON($RN1);
    
    }

    public function SearchByVendedor($request, $response, $args) {
        $vendedor = $args['vendedor'];
    
        $dao= new RN1DAO;    
        $RN1 = $dao->SearchByVendedor($vendedor);
        
        return $response->withJson($RN1);
    }
    
    public function SearchByAno($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN1DAO;    
        $RN1 = $dao->SearchByAno($ano);
        
        return $response->withJson($RN1);
    }

    public function SearchByAnoMes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN1DAO;    
        $RN1 = $dao->SearchByAnoMes($ano,$mes);
        
        return $response->withJson($RN1);
    }
}
?>
