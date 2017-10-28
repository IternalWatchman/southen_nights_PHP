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

$app->router->group([
	'namespace' => 'Lex\Controllers',
], function ($router) {
	$router->post('/calculate','Discount@calculate');
});

return $app;