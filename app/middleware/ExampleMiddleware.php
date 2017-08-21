<?php
namespace App\Middleware;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/**
 * Class ExampleMiddleware
 * @package     App\Middleware
 * @subpackage  Middleware
 * @since       v0.1.0
 *
 */
class ExampleMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @todo Remove comments and add pre response action
     */
    public function __invoke($request, $response, $next)
    {
        //$response->getBody()->write('BEFORE');
        $response = $next($request, $response);
        //$response->getBody()->write('AFTER');

        return $response;
    }
}
