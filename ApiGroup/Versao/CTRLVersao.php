<?php

include_once(__DIR__.'\objversao.php');
include_once(__DIR__.'\DAOversao.php');

class VersaoController {

    public function list($request, $response, $args){
        $dao= new VersaoDAO;    
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

        $dao = new VersaoDAO;
        $versao = $dao->insert($versao);

        return $response->withJson($versao,201);
    }

    public function SearchByversao($request, $response, $args) {
        $idversao = $args['idversao'];
        
        $dao= new VersaoDAO;    
        $versao = $dao->SearchByversao($idversao);
        
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

        $dao = new VersaoDAO;
        $versao = $dao->update($versao);

        return $response->withJson($versao);
    }
    
    public function delete($request, $response, $args) {
        $idversao = $args['idversao'];

        $dao = new VersaoDAO;
        $versao = $dao->delete($idversao);

        return $response->withJson($versao);
    }
}
?>
