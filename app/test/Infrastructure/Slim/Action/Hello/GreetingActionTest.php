<?php
declare(strict_types=1);

namespace Tests\Infrastructure\Slim\Action\Hello;

use App\Infrastructure\Slim\Action\ActionPayload;
use Tests\Infrastructure\Slim\Action\ActionTestCase;

class GreetingActionTest extends ActionTestCase
{
    private const FILE_PATH = '/app/src/Infrastructure/Slim/Action/Hello/GreetingAction.php';

    public function testAction()
    {
        $app = $this->getAppInstance();

        $request = $this->createRequest('GET', '/');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, [
             'message' => '¡Hola mundo!',
             'ruta' => self::FILE_PATH,
         ]);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
