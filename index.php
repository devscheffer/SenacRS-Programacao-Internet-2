<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

//define('__ROOT__', dirname(__DIR__));
//C:\laragon\www\PI2-Task01\Controller
//C:\laragon\www\OBJ\objUsuario.php

include_once(__DIR__.'\Controller\CTRLUsuario.php');
include_once(__DIR__.'\Controller\CTRLCarro.php');
include_once(__DIR__.'\Controller\CTRLConcessionaria.php');
include_once(__DIR__.'\Controller\CTRLCor.php');
include_once(__DIR__.'\Controller\CTRLModelo.php');
include_once(__DIR__.'\Controller\CTRLVenda.php');
include_once(__DIR__.'\Controller\CTRLVendedor.php');
include_once(__DIR__.'\Controller\CTRLVersao.php');


require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->post('/api/usuarios','UsuarioController:inserir');

$app->group('/api/carro'
    , function($app){

        $app->get('', 'CarroController:list');
        $app->post('', 'CarroController:insert');
        $app->get('/{chassi}', 'CarroController:searchbychassi');    
        $app->put('/{chassi}', 'CarroController:update');
        $app->delete('/{chassi}', 'CarroController:delete');

})->add('UsuarioController:validarToken');

$app->group('/api/concessionaria'
    , function($app){

        $app->get('', 'ConcessionariaController:list');
        $app->post('', 'ConcessionariaController:insert');
        $app->get('/{idconcessionaria}', 'ConcessionariaController:searchbyconcessionaria');    
        $app->put('/{idconcessionaria}', 'ConcessionariaController:update');
        $app->delete('/{idconcessionaria}', 'ConcessionariaController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/cor'
    , function($app){

        $app->get('', 'CTRLCor:list');
        $app->post('', 'CTRLCor:insert');
        $app->get('/{idcor}', 'CTRLCor:searchbycor');    
        $app->put('/{idcor}', 'CTRLCor:update');
        $app->delete('/{idcor}', 'CTRLCor:delete');

})->add('UsuarioController:validarToken');

$app->group('/api/modelo'
    , function($app){

        $app->get('', 'CTRLModelo:list');
        $app->post('', 'CTRLModelo:insert');
        $app->get('/{idmodelo}', 'CTRLModelo:searchbymodelo');    
        $app->put('/{idmodelo}', 'CTRLModelo:update');
        $app->delete('/{idmodelo}', 'CTRLModelo:delete');

})->add('UsuarioController:validarToken');

$app->group('/api/venda'
    , function($app){

        $app->get('', 'CTRLVenda:list');
        $app->post('', 'CTRLVenda:insert');
        $app->get('/{idsale}', 'CTRLVenda:searchbyvenda');    
        $app->put('/{idsale}', 'CTRLVenda:update');
        $app->delete('/{idsale}', 'CTRLVenda:delete');

})->add('UsuarioController:validarToken');

$app->group('/api/vendedor'
    , function($app){

        $app->get('', 'CTRLVendedor:list');
        $app->post('', 'CTRLVendedor:insert');
        $app->get('/{idvendedor}', 'CTRLVendedor:searchbyvendedor');    
        $app->put('/{idvendedor}', 'CTRLVendedor:update');
        $app->delete('/{idvendedor}', 'CTRLVendedor:delete');

})->add('UsuarioController:validarToken');

$app->group('/api/versao'
    , function($app){

        $app->get('', 'CTRLVersao:list');
        $app->post('', 'CTRLVersao:insert');
        $app->get('/{idversao}', 'CTRLVersao:searchbyversao');    
        $app->put('/{idversao}', 'CTRLVersao:update');
        $app->delete('/{idversao}', 'CTRLVersao:delete');

})->add('UsuarioController:validarToken');

$app->post('/api/auth','UsuarioController:autenticar');

$app->run();
?>