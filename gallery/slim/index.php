<?php

require __DIR__ . '/vendor/autoload.php';

use App\GreetAction;
use Slim\Factory\AppFactory;
use Nyholm\Psr7\Factory\Psr17Factory;

$psr17Factory = new Psr17Factory();
AppFactory::setResponseFactory($psr17Factory);
$app = AppFactory::create();

$app->get('/hello', function ($request, $response) {
    $response->getBody()->write('Hello, World!');
    return $response;
});

$app->get('/greet/{name}', GreetAction::class);
$app->get('/now-time', function ($request, $response) {
    $response->getBody()->write(date('c'));
    return $response;
});

$app->post('/echo', function ($request, $response) {
    $body = (string) $request->getBody();
    $response->getBody()->write('echo: ' . $body);
    return $response;
});

$app->addErrorMiddleware(true, true, true);

$app->run();
