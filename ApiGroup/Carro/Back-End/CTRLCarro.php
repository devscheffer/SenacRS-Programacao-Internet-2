<?php

include_once(__DIR__.'\objcarro.php');
include_once(__DIR__.'\DAOcarro.php');

class CarroController {

    public function list($request, $response, $args){
        $dao= new CarroDAO;    
        $carro = $dao->list();

        return $response->withJSON($carro);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $carro = new Carro(
            $data['chassi']
            ,$data['modelo']
            ,$data['versao']
            ,$data['cor']
        );

        $dao = new CarroDAO;
        $carro = $dao->insert($carro);

        return $response->withJson($carro,201);

    }

    public function SearchBychassi($request, $response, $args) {
        $chassi = $args['chassi'];
    
        $dao= new CarroDAO;    
        $carro = $dao->SearchBychassi($chassi);
        
        return $response->withJson($carro);
    }
    
    public function update($request, $response, $args) {
        $chassi = $args['chassi'];
        $data = $request->getParsedBody();
        $carro = new Carro(
            $chassi
            ,$data['modelo']
            ,$data['versao']
            ,$data['cor']
        );

        $dao = new CarroDAO;
        $carro = $dao->update($carro);

        return $response->withJson($carro);
    }
    
    public function delete($request, $response, $args) {
        $chassi = $args['chassi'];

        $dao = new CarroDAO;
        $carro = $dao->delete($chassi);

        return $response->withJson($carro);
    }
}
?>
