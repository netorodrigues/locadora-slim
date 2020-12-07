<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ItemController extends AbstractController
{
    public function get(Request $request, Response $response, $args)
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    public function post(Request $request, Response $response, $args)
    {
        var_dump($request->getParsedBody());
        $response->getBody()->write("Hello post world!");
        return $response;
    }
}
