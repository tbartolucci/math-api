<?php
namespace Bitsbybit\Math\Common\Action;

use Slim\Http\Request;
use Slim\Http\Response;

class ErrorHandler
{
    /**
     * @param Request $request
     * @param Response $response
     * @param \Exception $exception
     * @return Response
     */
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $status = $exception->getCode();
        if (!is_integer($status) || $status<100 || $status>599) {
            $status = 500;
        }

        return $response
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode([ 'code' => $exception->getCode(), 'message' => $exception->getMessage()]));
    }
}