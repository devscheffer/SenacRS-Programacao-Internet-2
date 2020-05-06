<?php

include_once(__DIR__.'\..\OBJ\objConcessionaria.php');
include_once(__DIR__.'\..\DAO\DAOConcessionaria.php');

class ConcessionariaController {

    public function list($request, $response, $args){
        $dao= new concessionariaDAO;    
        $concessionaria = $dao->list();

        return $response->withJSON($concessionaria);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $concessionaria = new concessionaria(
            $data['idconcessionaria']
            ,$data['nomefantasia']
            ,$data['uf']
            ,$data['municipio']
        );

        $dao = new concessionariaDAO;
        $concessionaria = $dao->insert($concessionaria);

        return $response->withJson($concessionaria,201);
    }

    public function SearchByConcessionaria($request, $response, $args) {
        $idconcessionaria = $args['idconcessionaria'];
    
        $dao= new concessionariaDAO;    
        $concessionaria = $dao->SearchByConcessionaria($idconcessionaria);
        
        return $response->withJson($concessionaria);
    }
    
    public function update($request, $response, $args) {
        $idconcessionaria = $args['idconcessionaria'];
        $data = $request->getParsedBody();
        $concessionaria = new concessionaria(
            $idconcessionaria
            ,$data['nomefantasia']
            ,$data['uf']
            ,$data['municipio']
        );

        $dao = new concessionariaDAO;
        $concessionaria = $dao->update($concessionaria);

        return $response->withJson($concessionaria);
    }
    
    public function delete($request, $response, $args) {
        $idconcessionaria = $args['idconcessionaria'];

        $dao = new concessionariaDAO;
        $concessionaria = $dao->delete($idconcessionaria);

        return $response->withJson($concessionaria);
    }
}
?>
