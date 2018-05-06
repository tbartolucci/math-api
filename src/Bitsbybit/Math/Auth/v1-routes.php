<?php
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;

$app->group( '/api/auth/v1',function(){

    // Routes
    $this->get( '/health', function (Request $request, Response $response, $args) {
        $action = $this->get('action-health');
        return $action->go($request, $response, $args);
    });

    $this->get( '/up', function (Request $request, Response $response, $args) {
        $action = $this->get('action-health');
        return $action->go($request, $response, $args);
    });

    $this->post('/login', function( Request $request, Response $response, array $args){
        $action = new \Bitsbybit\MathAuth\Action\Login($this->getContainer());
        return $action->login($request, $response, $args);
    });
});