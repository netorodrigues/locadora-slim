<?php

declare (strict_types = 1);
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

abstract class JSONController
{

    public function sendJson(Response $response,
        array $responseContent,
        int $status): Response {

        $responsePayload = json_encode($responseContent);
        $response->getBody()->write($responsePayload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
