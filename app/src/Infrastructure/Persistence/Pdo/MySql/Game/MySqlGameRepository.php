<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pdo\MySql\Game;

use App\Domain\Game\GameRepository;
use App\Infrastructure\Factory\GameFactory;
use Exception;
use PDO;

class MySqlGameRepository implements GameRepository
{
    /** @var PDO */
    private $pdo;
    protected const LIMITE = 3;

    public function __construct(PDO $pdo)
    {
       $this->pdo = $pdo;
    }

    /** @throws Exception */
    public function getGames(int $page, ?int $ini = 0): array
    {
       $sql = <<<SQL
SELECT
       s.id as `system_id`,
       s.name as `system_name`,
       `description`,
       generation,
       s.released_on as `system_released_on`,
       c.id as `company_id`,
       c.name as `company_name`,
       founded_on,
       location,
       g.id as `games_id`,
       title,
       type,
       g.released_on as `games_released_on`,
       system_id
FROM
     games g
     INNER JOIN systems s ON s.id = g.system_id
     INNER JOIN companies c ON c.id = g.company_id
LIMIT %s OFFSET :ini;
SQL;

       $statement = $this->pdo->prepare(
           sprintf($sql, self::LIMITE)
       );

       $statement->bindParam(':ini',$ini, PDO::PARAM_INT);
       $statement->execute();
       $result = $statement->fetchAll(PDO::FETCH_ASSOC);

       return array_map(function ($result) {
           return GameFactory::buildFromArray($result);
       }, $result);
    }

    /** @throws Exception */
    public function getGamesByCompanyId(int $id, int $page, int $ini): array
    {
        $sql = <<<SQL
SELECT
       s.id as `system_id`,
       s.name as `system_name`,
       `description`,
       generation,
       s.released_on as `system_released_on`,
       c.id as `company_id`,
       c.name as `company_name`,
       founded_on,
       location,
       g.id as `games_id`,
       title,
       type,
       g.released_on as `games_released_on`,
       system_id
FROM
     games g
     INNER JOIN systems s ON s.id = g.system_id
     INNER JOIN companies c ON c.id = g.company_id
WHERE g.company_id = :id
LIMIT %s OFFSET :ini;
SQL;
        $statement = $this->pdo->prepare(
            sprintf($sql, self::LIMITE)
        );

        $statement->bindParam(':ini',$ini, PDO::PARAM_INT);
        $statement->bindParam(':id',$id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($result){
            return GameFactory::buildFromArray($result);
        }, $result);

    }

    /** @throws Exception */
    public function getGamesBySystemId(int $id, int $page, int $ini): array
    {
        $sql = <<<SQL
SELECT
       s.id as `system_id`,
       s.name as `system_name`,
       `description`,
       generation,
       s.released_on as `system_released_on`,
       c.id as `company_id`,
       c.name as `company_name`,
       founded_on,
       location,
       g.id as `games_id`,
       title,
       type,
       g.released_on as `games_released_on`,
       system_id
FROM
     games g
     INNER JOIN systems s ON s.id = g.system_id
     INNER JOIN companies c ON c.id = g.company_id
WHERE g.system_id = :id
LIMIT %s OFFSET :ini;
SQL;
        $statement = $this->pdo->prepare(
            sprintf($sql, self::LIMITE)
        );

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':ini',$ini, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($result){
            return GameFactory::buildFromArray($result);
        }, $result);
    }
}
