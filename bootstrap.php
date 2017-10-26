<?php 

require 'vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Laravel\Lumen\Application(
    realpath(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Lex\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Lex\Console\Kernel::class
);

$app->router->group([
	'namespace' => 'Lex\Controllers',
], function ($router) {
	$router->post('/', 'DiscountController@calculate');
});

return $app;