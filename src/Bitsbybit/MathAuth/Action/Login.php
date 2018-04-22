<?php
namespace Bitsbybit\MathAuth\Action;
use Aws\CognitoIdentity\CognitoIdentityClient;
use Bitsbybit\Math\Action\BaseAction;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: tbart
 * Date: 4/21/2018
 * Time: 9:43 PM
 */

class Login extends BaseAction
{
    /**
     * @var CognitoIdentityClient
     */
    private $client;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function login( Request $request, Response $response, array $args): Response
    {
        $this->client = $this->container->get('aws-cognito-client');
    }
}