<?php 

require 'vendor/autoload.php';

$app = new Laravel\Lumen\Application(
	realpath(__DIR__)
);

$app->singleton(
	Illuminate\Contracts\Debug\ExceptionHandler::class,
	Lex\Exceptions\Handler::class
);

$app->middleware([
	Lex\Middleware\Api::class,
]);

$app->routeMiddleware([
	'discount' => Lex\Middleware\Discount::class,
]);

$app->withFacades();
$app->register(Lex\Providers\RestServiceProvider::class);

$app->router->group([
	'namespace' => 'Lex\Controllers',
], function ($router) {
	$router->get('/calculate/{order:[0-9]+}', 'Discount@get');
	$router->post('/calculate',[ 'middleware' => 'discount', 'uses' => 'Discount@post']);
});

return $app;