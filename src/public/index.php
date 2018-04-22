<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App;
$app->group('/api/users/v1',function(){
    $this->get('/up',function(Request $request, Response $response, array $args){
        return $response->withStatus(200);
    });

    $this->post('/login', function( Request $request, Response $response, array $args){
        $action = new \MathAuth\Action\Login();
        return $action->login($request, $response, $args);
    });

    $this->get('/{id}', function(Request $request, Response $response, array $args){

    });

    $this->put('/{id}', function(Request $request, Response $response, array $args){

    });

    $this->delete('/{id}', function(Request $request, Response $response, array $args){

    });

    $this->post('', function(Request $request, Response $response, array $args){

    });

    $this->get('/{id}/reset-password', function ($request, $response, $args) {
        // Route for /users/{id:[0-9]+}/reset-password
        // Reset the password for user identified by $args['id']
    })->setName('user-password-reset');
});

$app->run();