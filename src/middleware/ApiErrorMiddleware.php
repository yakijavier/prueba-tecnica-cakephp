<?php
declare(strict_types=1);

namespace App\Middleware;

use Exception;
use Cake\Http\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Cake\Controller\Exception\MissingActionException;

class ApiErrorMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (MissingActionException $e) {
            return new Response([
                'status' => 404,
                'type' => 'application/json',
                'body' => json_encode([
                    'error' => 'API endpoint not found',
                    'code' => 404
                ])
            ]);
        } catch (Exception $e) {
            return new Response([
                'status' => 500,
                'type' => 'application/json',
                'body' => json_encode([
                    'error' => 'Server error',
                    'message' => $e->getMessage(),
                    'code' => 500
                ])
            ]);
        }
    }
}
