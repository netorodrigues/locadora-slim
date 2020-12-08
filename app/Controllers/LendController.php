<?php

namespace App\Controllers;

use App\Factories\Contracts\LendFactory;
use App\Services\Lend\Contracts\CreateLendServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class LendController extends JSONController
{

    private $createLendService;
    private $lendFactory;
    public function __construct(
        CreateLendServiceInterface $createLendService,
        LendFactory $lendFactory

    ) {
        $this->createLendService = $createLendService;
        $this->lendFactory = $lendFactory;
    }

    public function get(Request $request, Response $response): Response
    {
        return $this->sendJson($response, ["lend" => "get route!"], 200);
    }

    public function post(Request $request, Response $response): Response
    {
        $lend = $this->lendFactory->fromRequest($request);
        $createdLend = $this->createLendService->execute($lend);
        return $this->sendJson($response, $createdLend->toArray(), 200);
    }

    public function delete(string $itemId, Request $request, Response $response): Response
    {
        return $this->sendJson($response, ['lend' => 'delete route!'], 200);
    }
}
