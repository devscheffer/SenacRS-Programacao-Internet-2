<?php

include_once(__DIR__.'\objcarro.php');
include_once(__DIR__.'\DAOcarro.php');
include_once(__DIR__.'\..\..\Modelo/Back-End\objModelo.php');
include_once(__DIR__.'\..\..\Modelo/Back-End\DAOModelo.php');
include_once(__DIR__.'\..\..\Versao/Back-End\objVersao.php');
include_once(__DIR__.'\..\..\Versao/Back-End\DAOVersao.php');
include_once(__DIR__.'\..\..\Cor/Back-End\objCor.php');
include_once(__DIR__.'\..\..\Cor/Back-End\DAOCor.php');

class CarroController {

	public function list($request, $response, $args){
		$dao= new CarroDAO;    
		$carro = $dao->list();

		return $response->withJSON($carro);
	
	}

	public function insert($request, $response, $args) {
		$data = $request->getParsedBody();

		$versaoDao = new VersaoDAO;
		$versao = $versaoDao->SearchByID(
			$data['versao']['idversao']
		);

		$corDao = new CorDAO;
		$cor = $corDao->SearchByID(
			$data['cor']['idcor']
		);

		$carro = new Carro(
			$data['chassi']
			,$versao
			,$cor
		);

		$dao = new CarroDAO;
		$carro = $dao->insert($carro);

		return $response->withJson($carro,201);

	}

	public function SearchByID($request, $response, $args) {
		$chassi = $args['chassi'];
	
		$dao= new CarroDAO;    
		$carro = $dao->SearchByID($chassi);
		
		return $response->withJson($carro);
	}
	
	public function update($request, $response, $args) {
		$chassi = $args['chassi'];
		$data = $request->getParsedBody();

		$versaoDao = new VersaoDAO;
		$versao = $versaoDao->SearchByID(
			$data['versao']['idversao']
		);

		$corDao = new CorDAO;
		$cor = $corDao->SearchByID(
			$data['cor']['idcor']
		);
		
		$carro = new Carro(
			$chassi
			,$versao
			,$cor
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
