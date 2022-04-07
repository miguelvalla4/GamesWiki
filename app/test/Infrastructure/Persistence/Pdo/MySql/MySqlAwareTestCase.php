<?php

declare(strict_types=1);

namespace Test\Infrastructure\Persistence\Pdo\MySql;

use PDO;
use Test\Infrastructure\ContainerAwareTestCase;

class MySqlAwareTestCase extends ContainerAwareTestCase
{
    public function getConnection()
    {
        $container = $this->getContainer();

        return $container->get(PDO::class);
    }
}
