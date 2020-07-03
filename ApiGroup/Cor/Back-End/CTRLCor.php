<?php

include_once(__DIR__.'\objcor.php');
include_once(__DIR__.'\DAOcor.php');

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

        $dao = new CorDAO;
        $cor = $dao->insert($cor);

        return $response->withJson($cor,201);
    }

    public function SearchBycor($request, $response, $args) {
        $idcor = $args['idcor'];
    
        $dao= new CorDAO;    
        $cor = $dao->SearchBycor($idcor);
        
        return $response->withJson($cor);
    }
    
    public function update($request, $response, $args) {
        $idcor = $args['idcor'];
        $data = $request->getParsedBody();
        $cor = new cor(
            $idcor
            ,$data['desccor']
        );

        $dao = new CorDAO;
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
