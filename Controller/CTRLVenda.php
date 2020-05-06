<?php

include_once(__DIR__.'\..\OBJ\objVenda.php');
include_once(__DIR__.'\..\DAO\DAOVenda.php');

class VendaController {

    public function list($request, $response, $args){
        $dao= new VendaDAO;    
        $venda = $dao->list();

        return $response->withJSON($venda);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $venda = new venda(
            $data['idsale']
            ,$data['concessionaria']
            ,$data['vendedor']
            ,$data['chassi']
            ,$data['data']
            ,$data['valor']
        );

        $dao = new VendaDAO;
        $venda = $dao->insert($venda);

        return $response->withJson($venda,201);
    }

    public function SearchByVenda($request, $response, $args) {
        $idsale = $args['idsale'];
    
        $dao= new vendaDAO;    
        $venda = $dao->SearchByVenda($idsale);
        
        return $response->withJson($venda);
    }
    
    public function update($request, $response, $args) {
        $idsale = $args['idsale'];
        $data = $request->getParsedBody();
        $venda = new venda(
            $idsale
            ,$data['concessionaria']
            ,$data['vendedor']
            ,$data['chassi']
            ,$data['data']
            ,$data['valor']
        );

        $dao = new vendaDAO;
        $venda = $dao->update($venda);

        return $response->withJson($venda);
    }
    
    public function delete($request, $response, $args) {
        $idsale = $args['idsale'];

        $dao = new vendaDAO;
        $venda = $dao->delete($idsale);

        return $response->withJson($venda);
    }
}
?>
