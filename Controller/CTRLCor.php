<?php

include_once(__DIR__.'\..\OBJ\objCor.php');
include_once(__DIR__.'\..\DAO\DAOCor.php');

class CorController {

    public function list($request, $response, $args){
        $dao= new CorDAO;    
        $cor = $dao->list();

        return $response->withJSON($cor);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $cor = new cor(
            $data['idcor']
            ,$data['desccor']
        );

        $dao = new corDAO;
        $cor = $dao->insert($cor);

        return $response->withJson($cor,201);
    }

    public function SearchByCor($request, $response, $args) {
        $idcor = $args['idcor'];
    
        $dao= new corDAO;    
        $cor = $dao->SearchByCor($idcor);
        
        return $response->withJson($cor);
    }
    
    public function update($request, $response, $args) {
        $idcor = $args['idcor'];
        $data = $request->getParsedBody();
        $cor = new cor(
            $idcor
            ,$data['desccor']
        );

        $dao = new corDAO;
        $cor = $dao->update($cor);

        return $response->withJson($cor);
    }
    
    public function delete($request, $response, $args) {
        $idcor = $args['idcor'];

        $dao = new CorDAO;
        $cor = $dao->delete($idcor);

        return $response->withJson($cor);
    }
}
?>
