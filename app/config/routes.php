<?php
declare(strict_types=1);

use App\Infrastructure\Slim\Action\Hello\GreetingAction;
use App\Infrastructure\Slim\Action\Game\GameAction;
use App\Infrastructure\Slim\Action\Companies\CompaniesAction;
use App\Infrastructure\Slim\Action\Systems\SystemsAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\PhpRenderer;

return static function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $renderer = new PhpRenderer(__DIR__ . '/../templates');
        return $renderer->render($response, 'homepage.html');
    });

    $app->get('/games', GameAction::class);
    $app->get('/companies/{id}', CompaniesAction::class);
    $app->get('/systems/{id}', SystemsAction::class);
};
