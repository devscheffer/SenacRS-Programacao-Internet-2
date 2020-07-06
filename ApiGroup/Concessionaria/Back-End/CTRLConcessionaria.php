<?php

include_once(__DIR__.'\objconcessionaria.php');
include_once(__DIR__.'\DAOconcessionaria.php');

class ConcessionariaController {

    public function list($request, $response, $args){
        $dao= new ConcessionariaDAO;    
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

        $dao = new ConcessionariaDAO;
        $concessionaria = $dao->insert($concessionaria);

        return $response->withJson($concessionaria,201);
    }

    public function SearchByID($request, $response, $args) {
        $idconcessionaria = $args['idconcessionaria'];
    
        $dao= new ConcessionariaDAO;    
        $concessionaria = $dao->SearchByID($idconcessionaria);
        
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

        $dao = new ConcessionariaDAO;
        $concessionaria = $dao->update($concessionaria);

        return $response->withJson($concessionaria);
    }
    
    public function delete($request, $response, $args) {
        $idconcessionaria = $args['idconcessionaria'];

        $dao = new ConcessionariaDAO;
        $concessionaria = $dao->delete($idconcessionaria);

        return $response->withJson($concessionaria);
    }
}
?>
