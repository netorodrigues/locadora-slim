<?php

namespace App\Controllers;

use App\Services\Lend\Contracts\CreateLendServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class LendController extends JSONController
{

    private $createLendService;
    public function __construct(
        CreateLendServiceInterface $createLendService
    ) {
        $this->createLendService = $createLendService;
    }

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
