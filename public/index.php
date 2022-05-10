<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ .'/../vendor/autoload.php';
require __DIR__ .'/../nosql/cach.php';

use NoSQL\Cach;
use NoSQL\Redis;


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {

    $html = file_get_contents(__DIR__.'/../view/index.html');

    $response->getBody()->write($html);
    return $response;
});

$app->get('/api/redis', function (Request $request, Response $response, $args) {
    try {
        $cach = new Cach(new Redis());

        $data = [
            'status' => true,
            'code' => 200,
            'data'=> $cach->getAll()
        ];

    } catch (\Throwable $ex) {
        $data = [
            'status' => false,
            'code' => 500,
            'data'=> [
                'message'=> $ex->getMessage()
            ]
        ];
    }

    $payload = json_encode($data);

    $response->getBody()->write($payload);

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
   
});


$app->delete('/api/redis/{key}', function (Request $request, Response $response, $args) {

    try {
        $cach = new Cach(new Redis());

        $cach->del($args['key']);
    
        $data = [
            'status' => true,
            'code' => 200,
            'data'=> $cach->getAll()
        ];
    } catch (\Throwable $ex) {
        $data = [
            'status' => false,
            'code' => 500,
            'data'=> [
                'message'=> $ex->getMessage()
            ]
        ];
    }

    $payload = json_encode($data);

    $response->getBody()->write($payload);

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});

$app->run();