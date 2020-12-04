<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HelloController
{

    public function get(Request $request, Response $response, $args)
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }
}
