<?php
namespace Bitsbybit\MathAuth\Action;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Bitsbybit\Math\Action\BaseAction;
use Slim\Container;
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
     * @var CognitoIdentityProviderClient
     */
    private $client;

    /**
     * @var string
     */
    private $userPoolId;

    public function __construct(Container $c, CognitoIdentityProviderClient $client, $userPoolId)
    {
        parent::__construct($c);
        $this->client = $client;
        $this->userPoolId = $userPoolId;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function login( Request $request, Response $response, array $args): Response
    {

        $this->client->adminInitiateAuth([
//            'AuthFlow' => 'USER_PASSWORD_AUTH', // REQUIRED
//            'AuthParameters' => ['<string>', ...],
//            'ClientId' => $this->userPoolId, // REQUIRED
//            'ClientMetadata' => ['<string>', ...],
//            'UserContextData' => [
//                'EncodedData' => '<string>',
//            ],
        ]);
    }
}