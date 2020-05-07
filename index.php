<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once(__DIR__.'\Controller\CTRLUsuario.php');
include_once(__DIR__.'\Controller\CTRLCarro.php');
include_once(__DIR__.'\Controller\CTRLConcessionaria.php');
include_once(__DIR__.'\Controller\CTRLCor.php');
include_once(__DIR__.'\Controller\CTRLModelo.php');
include_once(__DIR__.'\Controller\CTRLVenda.php');
include_once(__DIR__.'\Controller\CTRLVendedor.php');
include_once(__DIR__.'\Controller\CTRLVersao.php');
include_once(__DIR__.'\Controller\CTRLRN1.php');
include_once(__DIR__.'\Controller\CTRLRN2.php');
include_once(__DIR__.'\Controller\CTRLRN3.php');
include_once(__DIR__.'\Controller\CTRLRN4.php');

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->post('/api/usuarios','UsuarioController:inserir');

$app->group('/api/carro'
, function($app){
    
//OK
    $app->get('', 'CarroController:list');
//NOK
    $app->post('', 'CarroController:insert');
//NOK
    $app->get('/{chassi}', 'CarroController:searchbychassi');    
//NOK
    $app->put('/{chassi}', 'CarroController:update');
//NOK
    $app->delete('/{chassi}', 'CarroController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/concessionaria'
, function($app){
    
//OK
    $app->get('', 'ConcessionariaController:list');
//NOK
    $app->post('', 'ConcessionariaController:insert');
//NOK
    $app->get('/{idconcessionaria}', 'ConcessionariaController:searchbyconcessionaria');    
//NOK
    $app->put('/{idconcessionaria}', 'ConcessionariaController:update');
//NOK
    $app->delete('/{idconcessionaria}', 'ConcessionariaController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/cor'
, function($app){
    
//OK
    $app->get('', 'CorController:list');
//NOK
    $app->post('', 'CorController:insert');
//NOK
    $app->get('/{idcor}', 'CorController:searchbycor');    
//NOK
    $app->put('/{idcor}', 'CorController:update');
//NOK
    $app->delete('/{idcor}', 'CorController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/modelo'
, function($app){
    
//OK
    $app->get('', 'ModeloController:list');
//NOK
    $app->post('', 'ModeloController:insert');
//NOK
    $app->get('/{idmodelo}', 'ModeloController:searchbymodelo');    
//NOK
    $app->put('/{idmodelo}', 'ModeloController:update');
//NOK
    $app->delete('/{idmodelo}', 'ModeloController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/venda'
, function($app){
    
//OK
    $app->get('', 'VendaController:list');
//NOK
    $app->post('', 'VendaController:insert');
//NOK
    $app->get('/{idsale}', 'VendaController:searchbyvenda');    
//NOK
    $app->put('/{idsale}', 'VendaController:update');
//NOK
    $app->delete('/{idsale}', 'VendaController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/vendedor'
, function($app){
    
//OK
    $app->get('', 'VendedorController:list');
//NOK
    $app->post('', 'VendedorController:insert');
//NOK
    $app->get('/{idvendedor}', 'VendedorController:searchbyvendedor');    
//NOK
    $app->put('/{idvendedor}', 'VendedorController:update');
//NOK
    $app->delete('/{idvendedor}', 'VendedorController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/versao'
, function($app){
    
//OK
    $app->get('', 'VersaoController:list');
//NOK
    $app->post('', 'VersaoController:insert');
//NOK
    $app->get('/{idversao}', 'VersaoController:searchbyversao');    
//NOK
    $app->put('/{idversao}', 'VersaoController:update');
//NOK
    $app->delete('/{idversao}', 'VersaoController:delete');

});//->add('UsuarioController:validarToken');

/*
$app->group('/api/rn1'
, function($app){
    
//NOK
    $app->get('', 'RN1Controller:list');
//NOK
    $app->get('/{vendedor}', 'RN1Controller:SearchByVendedor');    
//NOK
    $app->get('/{ano}', 'RN1Controller:SearchByAno');
//NOK
    $app->get('/{ano}/{mes}', 'RN1Controller:SearchByAnoMes');    

});//->add('UsuarioController:validarToken');

$app->group('/api/rn2'
, function($app){

//NOK
    $app->get('', 'RN2Controller:list');
//NOK
    $app->get('/{vendedor}', 'RN2Controller:SearchByVendedor');    
//NOK
    $app->get('/{ano}', 'RN2Controller:SearchByAno');
//NOK
    $app->get('/{ano}/{mes}', 'RN2Controller:SearchByAnoMes');    

});//->add('UsuarioController:validarToken');

$app->group('/api/rn3'
    , function($app){

//NOK
    $app->get('', 'RN3Controller:list');
//NOK
    $app->get('/{vendedor}', 'RN3Controller:SearchByVendedor');    
//NOK
    $app->get('/{ano}', 'RN3Controller:SearchByAno');
//NOK
    $app->get('/{ano}/{mes}', 'RN3Controller:SearchByAnoMes');    

});//->add('UsuarioController:validarToken');

$app->group('/api/rn4'
    , function($app){

//NOK
    $app->get('', 'RN4Controller:list');
//NOK
    $app->get('/{vendedor}', 'RN4Controller:SearchByVendedor');    
//NOK
    $app->get('/{ano}', 'RN4Controller:SearchByAno');
//NOK
    $app->get('/{ano}/{mes}', 'RN4Controller:SearchByAnoMes');    

});//->add('UsuarioController:validarToken');
*/
$app->post('/api/auth','UsuarioController:autenticar');

$app->run();
?>