<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Cake\Http\Response;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Exception\BadRequestException;

class FriendlyBodyParserMiddleware extends BodyParserMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return parent::process($request, $handler);
        } catch (BadRequestException $e) {
            // Devolver una respuesta JSON personalizada directamente
            return new Response([
                'status' => 400,
                'type' => 'application/json',
                'body' => json_encode([
                    'error' => 'The request body is invalid.'
                ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
            ]);
        }
    }
}
