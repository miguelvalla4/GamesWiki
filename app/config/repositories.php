<?php
declare(strict_types=1);

use App\Domain\Game\GameRepository;

use App\Infrastructure\Persistence\Pdo\MySql\Game\MySqlGameRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return static function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        GameRepository::class => function (ContainerInterface $c) {
            return new MySqlGameRepository($c->get(PDO::class));
        },
    ]);
};
