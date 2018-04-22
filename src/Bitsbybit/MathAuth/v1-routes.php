<?php
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;

$app->group($baseUrl . '/v1',function(){

    $this->post('/login', function( Request $request, Response $response, array $args){
        $action = new \Bitsbybit\MathAuth\Action\Login($this->getContainer());
        return $action->login($request, $response, $args);
    });

    $this->get('/{id}/reset-password', function ($request, $response, $args) {
        // Route for /users/{id:[0-9]+}/reset-password
        // Reset the password for user identified by $args['id']
        return $response->withStatus(200);
    });

    $this->get('/{id}', function(Request $request, Response $response, array $args){
        return $response->withStatus(200);
    });

    $this->put('/{id}', function(Request $request, Response $response, array $args){
        return $response->withStatus(200);
    });

    $this->delete('/{id}', function(Request $request, Response $response, array $args){
        return $response->withStatus(200);
    });

    $this->post('', function(Request $request, Response $response, array $args){
        return $response->withStatus(200);
    });
});