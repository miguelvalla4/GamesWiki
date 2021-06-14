<?php
declare(strict_types=1);

use App\Infrastructure\Slim\Setting\Settings;
use App\Infrastructure\Slim\Setting\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return static function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'database' => [
                    'dbname' => $_ENV['DATABASE_NAME'],
                    'user' => $_ENV['DATABASE_USER'],
                    'password' => $_ENV['DATABASE_PASSWORD'],
                    'host' => $_ENV['DATABASE_HOST'],
                    'port' => $_ENV['DATABASE_PORT'],
                ],
            ]);
        }
    ]);
};
