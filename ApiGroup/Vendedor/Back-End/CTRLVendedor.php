<?php

include_once(__DIR__.'\objvendedor.php');
include_once(__DIR__.'\DAOvendedor.php');

class VendedorController {

    public function list($request, $response, $args){
        $dao= new VendedorDAO;    
        $vendedor = $dao->list();

        return $response->withJSON($vendedor);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $vendedor = new vendedor(
            $data['idvendedor']
            ,$data['nome']
            ,$data['email']
            ,$data['concessionaria']
        );

        $dao = new VendedorDAO;
        $vendedor = $dao->insert($vendedor);

        return $response->withJson($vendedor,201);
    }

    public function SearchByvendedor($request, $response, $args) {
        $idvendedor = $args['idvendedor'];
    
        $dao= new VendedorDAO;    
        $vendedor = $dao->SearchByvendedor($idvendedor);
        
        return $response->withJson($vendedor);
    }
    
    public function update($request, $response, $args) {
        $idvendedor = $args['idvendedor'];
        $data = $request->getParsedBody();
        $vendedor = new vendedor(
            $idvendedor
            ,$data['nome']
            ,$data['email']
            ,$data['concessionaria']
        );

        $dao = new VendedorDAO;
        $vendedor = $dao->update($vendedor);

        return $response->withJson($vendedor);
    }
    
    public function delete($request, $response, $args) {
        $idvendedor = $args['idvendedor'];

        $dao = new VendedorDAO;
        $vendedor = $dao->delete($idvendedor);

        return $response->withJson($vendedor);
    }
}
?>
