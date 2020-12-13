<?php

declare (strict_types = 1);
namespace App\Controllers;

use App\Exceptions\ItemDoesntExistsException;
use App\Exceptions\ItemUnavailableException;
use App\Exceptions\ValueObjects\InvalidEmailReceivedException;
use App\Factories\Contracts\LendFactoryInterface;
use App\Services\Lend\Contracts\CreateLendServiceInterface;
use App\Services\Lend\Contracts\DeleteLendServiceInterface;
use App\Services\Lend\Contracts\GetLendsServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

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
        LendFactoryInterface $lendFactory

    ) {
        $this->createLendService = $createLendService;
        $this->getLendsService = $getLendService;
        $this->deleteLendService = $deleteLendService;

        $this->lendFactory = $lendFactory;
    }

    public function get(Request $request, Response $response): Response
    {
        try {

            $lends = $this->getLendsService->execute();

            return $this->responseOk($response, $lends);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }

    public function post(Request $request, Response $response): Response
    {

        try {
            $lend = $this->lendFactory->fromRequest($request);
            $createdLend = $this->createLendService->execute($lend);

            return $this->responseCreated($response, $createdLend->toArray());
        } catch (ItemUnavailableException $e) {
            return $this->responseForbidden($response, [$e->getMessage()]);
        } catch (ItemDoesntExistsException $e) {
            return $this->responseNotAcceptable($response, [$e->getMessage()]);
        } catch (InvalidEmailReceivedException $e) {
            return $this->responseBadRequest($response, [$e->getMessage()]);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }

    public function delete(string $id, Request $request, Response $response): Response
    {

        try {

            $wasDeleted = $this->deleteLendService->execute($id);

            return $this->responseOk($response, ['deleted' => $wasDeleted]);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }
}
