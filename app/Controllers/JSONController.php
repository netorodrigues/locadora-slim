<?php

declare (strict_types = 1);
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

abstract class JSONController
{

    private function json(Response $response,
        array $responseContent,
        int $status): Response {

        $responsePayload = json_encode($responseContent);
        $response->getBody()->write($responsePayload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }

    public function responseOk(Response $response, array $responseContent)
    {
        return $this->json($response, $responseContent, 200);
    }

    public function responseCreated(Response $response, array $responseContent)
    {
        return $this->json($response, $responseContent, 201);
    }

    public function responseBadRequest(Response $response, array $responseContent)
    {
        return $this->json($response, ['error' => $responseContent], 400);
    }

    public function responseForbidden(Response $response, array $responseContent)
    {
        return $this->json($response, ['error' => $responseContent], 403);
    }

    public function responseNotAcceptable(Response $response, array $responseContent)
    {
        return $this->json($response, ['error' => $responseContent], 406);
    }

    public function responseInternalServerError(Response $response, array $responseContent)
    {
        return $this->json($response, ['error' => $responseContent], 500);
    }

}
