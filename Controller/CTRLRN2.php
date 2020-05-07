<?php

include_once(__DIR__.'\..\OBJ\objRN2.php');
include_once(__DIR__.'\..\DAO\DAORN2.php');

class RN2Controller {

    public function list($request, $response, $args){
        $dao= new RN2DAO;    
        $RN2 = $dao->list();

        return $response->withJSON($RN2);
    
    }

    public function SearchByVendedor($request, $response, $args) {
        $vendedor = $args['vendedor'];
    
        $dao= new RN2DAO;    
        $RN2 = $dao->SearchByVendedor($vendedor);
        
        return $response->withJson($RN2);
    }
    
    public function SearchByAno($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN2DAO;    
        $RN2 = $dao->SearchByAno($ano);
        
        return $response->withJson($RN2);
    }

    public function SearchByAnoMes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN2DAO;    
        $RN2 = $dao->SearchByAnoMes($ano,$mes);
        
        return $response->withJson($RN2);
    }
}
?>
