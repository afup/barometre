<?php

namespace Afup\Barometre\Query;

use Doctrine\DBAL\Connection;
use \Doctrine\DBAL\Query\QueryBuilder as BaseQueryBuilder;

class QueryBuilder extends BaseQueryBuilder
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        parent::__construct($connection);
    }

    /**
     * @param string $tablename
     */
    public function createTemporaryTable($tablename)
    {
        $sql = sprintf('CREATE TEMPORARY TABLE `%s` %s', $tablename, $this->getSQL());
        return $this->connection->executeUpdate($sql, $this->getParameters());
    }

    /**
     * @param string $tablename
     */
    public function dropTemporaryTable($tablename)
    {
        $sql = sprintf('DROP TEMPORARY TABLE IF EXISTS `%s`', $tablename);
        return $this->connection->executeUpdate($sql);
    }
}
