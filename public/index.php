<?php
/*Define uma constante com o diretório pai do diretório que está inserido esse arquivo*/
define('APP_ROOT', dirname(__DIR__));

/*Troca para o diretório que foi definedo na constante no caso o diretório pai do diretório do arquivo*/
chdir(APP_ROOT);

//Imports
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
require 'vendor/autoload.php';

/*Cria uma nova instância da aplicação*/
$app = new Application();

/*Ligando o debug*/
$app['debug'] = true;

/*Middlewares são ações que devem ser executadas antes ou depois das rotas*/
/*Before é executado antes da resquest da rota em questão*/
$app->before(function(Request $request){
	print 'Antes das rotas - ';
});
/*After é executado na hora do response da rota então é executado antes da resposta da outra rota ser retornada*/
$app->after(function(Request $request, Response $response){
	print 'Depois das rotas - ';
});

/*O Finish é executado após o response da rota em questão*/
$app->finish(function(Request $request, Response $response){
	print ' - Finish';
});

//Rotas
$app->get('/', function() use ($app){
	return $app->json(array('Hello World!'));
});

/*Middlewares de rota são middleware que são executados dentro de sua própria rota em questão não extendedo suas funções para outras rotas*/
$app->get('/users', function() use ($app){
	return $app->json(array('Usuários'));
})->before(function(){
	print 'Antes dessa rota';
})->after(function(){
	print 'Antes da response';
});

$app->mount('/blog', require 'src/Controllers/BlogController.php');
$app->mount('/profile', require 'src/Controllers/UserController.php');

//Run roda a aplicação
$app->run();