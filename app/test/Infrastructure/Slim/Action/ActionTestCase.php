<?php

declare(strict_types=1);

namespace Test\Infrastructure\Slim\Action;

use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Uri;
use Test\Infrastructure\ContainerAwareTestCase;

class ActionTestCase extends ContainerAwareTestCase
{
    /**
     * @return App
     * @throws Exception
     */
    protected function getAppInstance(): App
    {
        // Instantiate the app
        AppFactory::setContainer($this->getContainer());
        $app = AppFactory::create();

        // Register middleware
        $middleware = require __DIR__ . '/../../../../config/middleware.php';
        $middleware($app);

        // Register routes
        $routes = require __DIR__ . '/../../../../config/routes.php';
        $routes($app);

        return $app;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $headers
     * @param array  $cookies
     * @param array  $serverParams
     * @return Request
     */
    protected function createRequest(
        string $method,
        string $path,
        array $headers = ['HTTP_ACCEPT' => 'application/json'],
        array $cookies = [],
        array $serverParams = []
    ): Request {
        $uri = new Uri('', '', 80, $path);
        $handle = fopen('php://temp', 'w+');
        $stream = (new StreamFactory())->createStreamFromResource($handle);

        $h = new Headers();
        foreach ($headers as $name => $value) {
            $h->addHeader($name, $value);
        }

        return new SlimRequest($method, $uri, $h, $cookies, $serverParams, $stream);
    }
}
