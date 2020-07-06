<?php

include_once(__DIR__.'\objVenda.php');
include_once(__DIR__.'\DAOVenda.php');
include_once(__DIR__.'\..\..\Concessionaria/Back-End\objConcessionaria.php');
include_once(__DIR__.'\..\..\Concessionaria/Back-End\DAOConcessionaria.php');
include_once(__DIR__.'\..\..\Vendedor/Back-End\objVendedor.php');
include_once(__DIR__.'\..\..\Vendedor/Back-End\DAOVendedor.php');
include_once(__DIR__.'\..\..\Carro/Back-End\objCarro.php');
include_once(__DIR__.'\..\..\Carro/Back-End\DAOCarro.php');

class VendaController {

    public function list($request, $response, $args){
        $dao= new VendaDAO;    
        $venda = $dao->list();

        return $response->withJSON($venda);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();

        $concessionariaDao = new ConcessionariaDAO;
		$concessionaria = $concessionariaDao->SearchByID(
			$data['concessionaria']['idconcessionaria']
        );
        
        $vendedorDao = new VendedorDAO;
		$vendedor = $vendedorDao->SearchByID(
			$data['vendedor']['idvendedor']
        );

        $carroDao = new CarroDAO;
		$carro = $carroDao->SearchByID(
			$data['carro']['chassi']
        );

        $venda = new venda(
            $data['idvenda']
            ,$data['venda_data']
            ,$data['valor']
            ,$concessionaria
            ,$vendedor
            ,$carro
        );

        $dao = new VendaDAO;
        $venda = $dao->insert($venda);

        return $response->withJson($venda,201);
    }

    public function SearchByID($request, $response, $args) {
        $idvenda = $args['idvenda'];
    
        $dao= new VendaDAO;    
        $venda = $dao->SearchByID($idvenda);
        
        return $response->withJson($venda);
    }
    
    public function update($request, $response, $args) {
        $idvenda = $args['idvenda'];
        $data = $request->getParsedBody();

        $concessionariaDao = new ConcessionariaDAO;
		$concessionaria = $concessionariaDao->SearchByID(
			$data['concessionaria']['idconcessionaria']
        );
        
        $vendedorDao = new VendedorDAO;
		$vendedor = $vendedorDao->SearchByID(
			$data['vendedor']['idvendedor']
        );

        $carroDao = new CarroDAO;
		$carro = $carroDao->SearchByID(
			$data['carro']['chassi']
        );

        $venda = new venda(
            $idvenda
            ,$data['venda_data']
            ,$data['valor']
            ,$concessionaria
            ,$vendedor
            ,$carro
        );

        $dao = new vendaDAO;
        $venda = $dao->update($venda);

        return $response->withJson($venda);
    }
    
    public function delete($request, $response, $args) {
        $idvenda = $args['idvenda'];

        $dao = new vendaDAO;
        $venda = $dao->delete($idvenda);

        return $response->withJson($venda);
    }
}
?>
