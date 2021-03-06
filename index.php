<?php
use Slim\Factory\AppFactory;
use Psr\Http\message\ResponseInterface as Response;
use Psr\Http\message\ServerRequestInterface as Request;


include_once(__DIR__.'\APIGroup\Carro\Back-End\CTRLCarro.php');
include_once(__DIR__.'\APIGroup\Cor\Back-End\CTRLCor.php');
include_once(__DIR__.'\APIGroup\Modelo\Back-End\CTRLModelo.php');
include_once(__DIR__.'\APIGroup\Versao\Back-End\CTRLVersao.php');
include_once(__DIR__.'\APIGroup\Concessionaria\Back-End\CTRLConcessionaria.php');
include_once(__DIR__.'\APIGroup\Venda\Back-End\CTRLVenda.php');
include_once(__DIR__.'\APIGroup\Vendedor\Back-End\CTRLVendedor.php');

include_once(__DIR__.'\APIGroup\Usuario\Back-End\CTRLUsuario.php');

include_once(__DIR__.'\APIGroup\RN\RN1\Back-End\CTRLRN1.php');
include_once(__DIR__.'\APIGroup\RN\RN2\Back-End\CTRLRN2.php');
include_once(__DIR__.'\APIGroup\RN\RN3\Back-End\CTRLRN3.php');
include_once(__DIR__.'\APIGroup\RN\RN4\Back-End\CTRLRN4.php');

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();


$customErrorHandler = function (
    Psr\Http\Message\ServerRequestInterface $request,
    \Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write('not found');
    return $response->withStatus(404);
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(Slim\Exception\HttpNotFoundException::class, $customErrorHandler);




$app->post('/api/usuario','UsuarioController:inserir');

$app->group('/api/carro'
, function($app){
    
    $app->get('', 'CarroController:list');
    $app->post('', 'CarroController:insert');
    $app->get('/{chassi}', 'CarroController:SearchByID');    
    $app->put('/{chassi}', 'CarroController:update');
    $app->delete('/{chassi}', 'CarroController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/concessionaria'
, function($app){
    

    $app->get('', 'ConcessionariaController:list');
    $app->post('', 'ConcessionariaController:insert');
    $app->get('/{idconcessionaria}', 'ConcessionariaController:SearchByID');    
    $app->put('/{idconcessionaria}', 'ConcessionariaController:update');
    $app->delete('/{idconcessionaria}', 'ConcessionariaController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/cor'
, function($app){
    
    $app->get('', 'CorController:list');
    $app->post('', 'CorController:insert');
    $app->get('/{idcor}', 'CorController:SearchByID');    
    $app->put('/{idcor}', 'CorController:update');
    $app->delete('/{idcor}', 'CorController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/modelo'
, function($app){
    
    $app->get('', 'ModeloController:list');
    $app->post('', 'ModeloController:insert');
    $app->get('/{idmodelo}', 'ModeloController:SearchByID');    
    $app->put('/{idmodelo}', 'ModeloController:update');
    $app->delete('/{idmodelo}', 'ModeloController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/venda'
, function($app){
    
    $app->get('', 'VendaController:list');
    $app->post('', 'VendaController:insert');
    $app->get('/{idvenda}', 'VendaController:SearchByID');    
    $app->put('/{idvenda}', 'VendaController:update');
    $app->delete('/{idvenda}', 'VendaController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/vendedor'
, function($app){
    
    $app->get('', 'VendedorController:list');
    $app->post('', 'VendedorController:insert');
    $app->get('/{idvendedor}', 'VendedorController:searchbyid');    
    $app->put('/{idvendedor}', 'VendedorController:update');
    $app->delete('/{idvendedor}', 'VendedorController:delete');

});//->add('UsuarioController:validarToken');

$app->group('/api/versao'
, function($app){
    
    $app->get('', 'VersaoController:list');
    $app->post('', 'VersaoController:insert');
    $app->get('/{idversao}', 'VersaoController:SearchByID');    
    $app->put('/{idversao}', 'VersaoController:update');
    $app->delete('/{idversao}', 'VersaoController:delete');

});//->add('UsuarioController:validarToken');


$app->group('/api/rn1'
, function($app){
    
    $app->get('', 'RN1Controller:list');
    $app->get('/vendedor/{vendedor}', 'RN1Controller:SearchByvendedor');    
    $app->get('/ano/{ano}', 'RN1Controller:SearchByano');
    $app->get('/anomes/{ano}/{mes}', 'RN1Controller:SearchByanomes');    

});//->add('UsuarioController:validarToken');

$app->group('/api/rn2'
, function($app){

    $app->get('', 'RN2Controller:list');
    $app->get('/vendedor/{vendedor}', 'RN2Controller:searchbyid');    
    $app->get('/ano/{ano}', 'RN2Controller:SearchByano');
    $app->get('/anomes/{ano}/{mes}', 'RN2Controller:SearchByanomes');    

});//->add('UsuarioController:validarToken');

$app->group('/api/rn3'
    , function($app){

    $app->get('', 'RN3Controller:list');
    $app->get('/concessionaria/{concessionaria}', 'RN3Controller:SearchByID');    
    $app->get('/ano/{ano}', 'RN3Controller:SearchByano');
    $app->get('/anomes/{ano}/{mes}', 'RN3Controller:SearchByanomes');    

});//->add('UsuarioController:validarToken');

$app->group('/api/rn4'
    , function($app){

    $app->get('', 'RN4Controller:list');
    $app->get('/vendedor/{vendedor}', 'RN4Controller:searchbyid');    
    $app->get('/ano/{ano}', 'RN4Controller:SearchByano');
    $app->get('/anomes/{ano}/{mes}', 'RN4Controller:SearchByanomes');    

});//->add('UsuarioController:validarToken');



$app->post('/api/auth','UsuarioController:autenticar');

$app->run();
?>