<?php

include_once(__DIR__.'\..\OBJ\objVersao.php');
include_once(__DIR__.'\..\DAO\DAOVersao.php');

class VersaoController {

    public function list($request, $response, $args){
        $dao= new versaoDAO;    
        $versao = $dao->list();

        return $response->withJSON($versao);
    
    }

    public function insert($request, $response, $args) {
        $data = $request->getParsedBody();
        $versao = new versao(
            $data['idversao']
            ,$data['idmodelo']
            ,$data['descversao']
        );

        $dao = new versaoDAO;
        $versao = $dao->insert($versao);

        return $response->withJson($versao,201);
    }

    public function SearchByVersao($request, $response, $args) {
        $idversao = $args['idversao'];
        
        $dao= new versaoDAO;    
        $versao = $dao->SearchByVersao($idversao);
        
        return $response->withJson($versao);
    }
    
    public function update($request, $response, $args) {
        $idversao = $args['idversao'];
        $data = $request->getParsedBody();
        $versao = new versao(
            $idversao
            ,$data['idmodelo']
            ,$data['descversao']
        );

        $dao = new versaoDAO;
        $versao = $dao->update($versao);

        return $response->withJson($versao);
    }
    
    public function delete($request, $response, $args) {
        $idversao = $args['idversao'];

        $dao = new versaoDAO;
        $versao = $dao->delete($idversao);

        return $response->withJson($versao);
    }
}
?>
