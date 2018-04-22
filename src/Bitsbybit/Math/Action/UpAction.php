<?php
namespace Bitsbybit\Math\Action;

use Slim\Http\Request;
use Slim\Http\Response;

class UpAction extends BaseAction implements ActionInterface
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