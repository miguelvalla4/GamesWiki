<?php

declare(strict_types=1);

namespace Test\Infrastructure;

use DI\ContainerBuilder;
use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

class ContainerAwareTestCase extends TestCase
{
    /** @throws Exception */
    public function getContainer()
    {
        // Instantiate PHP-DI ContainerBuilder
        $containerBuilder = new ContainerBuilder();

        // Container intentionally not compiled for tests.

        (new Dotenv())->load(__DIR__ . '/../../.env');

        // Set up settings
        $settings = require __DIR__ . '/../../config/settings.php';
        $settings($containerBuilder);

        // Set up dependencies
        $dependencies = require __DIR__ . '/../../config/dependencies.php';
        $dependencies($containerBuilder);

        // Set up repositories
        $repositories = require __DIR__ . '/../../config/repositories.php';
        $repositories($containerBuilder);

        // Build PHP-DI Container instance
        return $containerBuilder->build();
    }
}
