<?php

include_once(__DIR__.'\objvendedor.php');
include_once(__DIR__.'\DAOvendedor.php');
include_once(__DIR__.'\..\..\Concessionaria\Back-End\objConcessionaria.php');
include_once(__DIR__.'\..\..\Concessionaria\Back-End\DAOConcessionaria.php');

class VendedorController {

	public function list($request, $response, $args){
		$dao= new VendedorDAO;    
		$vendedor = $dao->list();

		return $response->withJSON($vendedor);
	
	}

	public function insert($request, $response, $args) {
		$data = $request->getParsedBody();

		$concessionariaDAO = new ConcessionariaDAO;
		$concessionaria = $concessionariaDAO->SearchByID(
			$data['concessionaria']['idconcessionaria']
			
		);

		$vendedor = new Vendedor(
			$data['idvendedor']
			,$data['nome']
			,$data['email']
			,$concessionaria
		);

		$dao = new VendedorDAO;
		$vendedor = $dao->insert($vendedor);

		return $response->withJson($vendedor,201);
	}

	public function SearchByID($request, $response, $args) {
		$idvendedor = $args['idvendedor'];
	
		$dao= new VendedorDAO;    
		$vendedor = $dao->SearchByID($idvendedor);
		
		return $response->withJson($vendedor);
	}
	
	public function update($request, $response, $args) {
		$idvendedor = $args['idvendedor'];
		$data = $request->getParsedBody();

		$concessionariaDao = new ConcessionariaDAO;
        $concessionaria = $concessionariaDao->SearchByID(
            $data['concessionaria']['idconcessionaria']
		);
		
		$vendedor = new Vendedor(
			$idvendedor
			,$data['nome']
			,$data['email']
			,$concessionaria
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
