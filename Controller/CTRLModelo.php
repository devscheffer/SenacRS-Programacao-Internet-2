<?php

include_once(__DIR__.'\..\OBJ\objModelo.php');
include_once(__DIR__.'\..\DAO\DAOModelo.php');

class ModeloController {

    public function list($request, $response, $args){
        $dao= new ModeloDAO;    
        $modelo = $dao->list();

        return $response->withJSON($modelo);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $modelo = new modelo(
            $data['idmodelo']
            ,$data['descmodelo']
        );

        $dao = new modeloDAO;
        $modelo = $dao->insert($modelo);

        return $response->withJson($modelo,201);
    }

    public function SearchByModelo($request, $response, $args) {
        $idmodelo = $args['idmodelo'];
        
        $dao= new modeloDAO;    
        $modelo = $dao->SearchByModelo($idmodelo);
        
        return $response->withJson($modelo);
    }
    
    public function update($request, $response, $args) {
        $idmodelo = $args['idmodelo'];
        $data = $request->getParsedBody();
        $modelo = new modelo(
            $idmodelo
            ,$data['descmodelo']
        );

        $dao = new modeloDAO;
        $modelo = $dao->update($modelo);

        return $response->withJson($modelo);
    }
    
    public function delete($request, $response, $args) {
        $idmodelo = $args['idmodelo'];

        $dao = new modeloDAO;
        $modelo = $dao->delete($idmodelo);

        return $response->withJson($modelo);
    }
}
?>
