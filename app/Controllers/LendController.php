<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class LendController extends JSONController
{

    public function __construct()
    {}

    public function get(Request $request, Response $response): Response
    {
        return $this->sendJson($response, ["lend" => "get route!"], 200);
    }

    public function post(Request $request, Response $response): Response
    {
        return $this->sendJson($response, ['lend' => 'post route!'], 200);
    }

    public function delete(string $itemId, Request $request, Response $response): Response
    {
        return $this->sendJson($response, ['lend' => 'delete route!'], 200);
    }
}
