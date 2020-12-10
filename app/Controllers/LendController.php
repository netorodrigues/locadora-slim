<?php

namespace App\Controllers;

use App\Factories\Contracts\LendFactory;
use App\Services\Lend\Contracts\CreateLendServiceInterface;
use App\Services\Lend\Contracts\DeleteLendServiceInterface;
use App\Services\Lend\Contracts\GetLendsServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class LendController extends JSONController
{

    private $createLendService;
    private $getLendsService;
    private $deleteLendService;

    private $lendFactory;

    public function __construct(
        CreateLendServiceInterface $createLendService,
        GetLendsServiceInterface $getLendService,
        DeleteLendServiceInterface $deleteLendService,
        LendFactory $lendFactory

    ) {
        $this->createLendService = $createLendService;
        $this->getLendsService = $getLendService;
        $this->deleteLendService = $deleteLendService;

        $this->lendFactory = $lendFactory;
    }

    public function get(Request $request, Response $response): Response
    {
        $lends = $this->getLendsService->execute();
        return $this->sendJson($response, $lends, 200);
    }

    public function post(Request $request, Response $response): Response
    {
        $lend = $this->lendFactory->fromRequest($request);
        $createdLend = $this->createLendService->execute($lend);
        return $this->sendJson($response, $createdLend->toArray(), 201);
    }

    public function delete(string $itemId, Request $request, Response $response): Response
    {
        $wasDeleted = $this->deleteLendService->execute($itemId);
        return $this->sendJson($response, ['deleted' => $wasDeleted], 200);
    }
}
