<?php

include_once(__DIR__.'\..\OBJ\objRN4.php');
include_once(__DIR__.'\..\DAO\DAORN4.php');

class RN4Controller {

    public function list($request, $response, $args){
        $dao= new RN4DAO;    
        $RN4 = $dao->list();

        return $response->withJSON($RN4);
    
    }

    public function SearchByVendedor($request, $response, $args) {
        $vendedor = $args['vendedor'];
    
        $dao= new RN4DAO;    
        $RN4 = $dao->SearchByVendedor($vendedor);
        
        return $response->withJson($RN4);
    }
    
    public function SearchByAno($request, $response, $args) {
        $ano = $args['ano'];
    
        $dao= new RN4DAO;    
        $RN4 = $dao->SearchByAno($ano);
        
        return $response->withJson($RN4);
    }

    public function SearchByAnoMes($request, $response, $args) {
        $ano = $args['ano'];
        $mes = $args['mes'];
    
        $dao= new RN4DAO;    
        $RN4 = $dao->SearchByAnoMes($ano,$mes);
        
        return $response->withJson($RN4);
    }
}
?>
