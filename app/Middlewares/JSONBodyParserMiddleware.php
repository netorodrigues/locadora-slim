<?php

declare (strict_types = 1);
namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class JSONBodyParserMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $contents = json_decode(file_get_contents('php://input'), true);
        $request = $request->withParsedBody($contents);

        return $handler->handle($request);
    }
}
