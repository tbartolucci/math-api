<?php

namespace Bitsbybit\Math\Common\Action;

use Slim\Http\Request;
use Slim\Http\Response;

interface ActionInterface
{
    public function go(Request $request, Response $response, array $args = []): Response;
}