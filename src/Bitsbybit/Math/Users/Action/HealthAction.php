<?php
namespace Bitsbybit\Math\Users\Action;

use Slim\Http\Request;
use Slim\Http\Response;
use Bitsbybit\Math\Common\Action\ActionInterface;
use Bitsbybit\Math\Common\Action\BaseAction;

class HealthAction extends BaseAction implements ActionInterface
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function go(Request $request, Response $response, array $args = []): Response
    {
        return $response->withStatus(200);
    }
}