<?php

declare (strict_types = 1);
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class PreflightController extends JSONController
{

    public function options(Request $request, Response $response): Response
    {
        return $response;
    }
}
