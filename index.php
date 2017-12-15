<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'setting.php';

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();



require 'pdo.php';

require 'routes/hello.php';
require 'routes/user.php';
require 'routes/rooms.php';


// $app->get('/category',function(){
//      echo' /category'; });

// $app->get('/category/product',function(){
//      echo' /category/product'; });



$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();