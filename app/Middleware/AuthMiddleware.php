<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

/**
 * AuthMiddleware
 *
 * @author    Haven Shen <havenshen@gmail.com>
 * @copyright    Copyright (c) Haven Shen
 */
class AuthMiddleware extends Middleware
{

	public function __invoke(Request $request, RequestHandler $handler): Response
	{
		if(! $this->container->get('auth')->check()) {
			$this->container->get('flash')->addMessage('error', 'Please sign in before doing that');
			return $response->withRedirect($this->container->get('router')->urlFor('auth.signin'));
		}

		$response = $handler->handle($request);
		return $response;
	}
}