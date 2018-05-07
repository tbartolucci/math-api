<?php
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;

$app->group( '/api/users/v1',function(){

    // Routes
    $this->get( '/health', function (Request $request, Response $response, $args) {
        $action = $this->get('users-action-health');
        return $action->go($request, $response, $args);
    });

    $this->get( '/up', function (Request $request, Response $response, $args) {
        $action = $this->get('users-action-health');
        return $action->go($request, $response, $args);
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