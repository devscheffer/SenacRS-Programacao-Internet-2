<?php

include_once(__DIR__.'\..\OBJ\objCarro.php');
include_once(__DIR__.'\..\DAO\DAOCarro.php');

class CarroController {

    public function list($request, $response, $args){
        $dao= new CarroDAO;    
        $carro = $dao->list();

        return $response->withJSON($carro);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $Carro = new Carro(
            $data['chassi']
            ,$data['modelo']
            ,$data['versao']
            ,$data['cor']
        );

        $dao = new CarroDAO;
        $Carro = $dao->insert($Carro);

        return $response->withJson($Carro,201);
    }

    public function SearchByChassi($request, $response, $args) {
        $chassi = $args['chassi'];
    
        $dao= new CarroDAO;    
        $Carro = $dao->SearchByChassi($chassi);
        
        return $response->withJson($Carro);
    }
    
    public function update($request, $response, $args) {
        $chassi = $args['chassi'];
        $data = $request->getParsedBody();
        $Carro = new Carro(
            $chassi
            ,$data['modelo']
            ,$data['versao']
            ,$data['cor']
        );

        $dao = new CarroDAO;
        $Carro = $dao->update($Carro);

        return $response->withJson($Carro);
    }
    
    public function delete($request, $response, $args) {
        $chassi = $args['chassi'];

        $dao = new CarroDAO;
        $Carro = $dao->delete($chassi);

        return $response->withJson($Carro);
    }
}
?>
