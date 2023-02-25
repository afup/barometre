<?php

declare(strict_types=1);

namespace App\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder as BaseQueryBuilder;

class QueryBuilder extends BaseQueryBuilder
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var array
     */
    protected $paramTypes = [];

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

        $this->connection->executeStatement($sql, $this->getParameters(), $this->paramTypes);
    }

    /**
     * @param string $tablename
     */
    public function dropTemporaryTable($tablename)
    {
        $sql = sprintf('DROP TEMPORARY TABLE IF EXISTS `%s`', $tablename);

        $this->connection->executeStatement($sql);
    }

    /**
     * paramTypes is private, we need to redefine setParameter
     * to access it.
     *
     * @param string $key
     * @param string $value
     * @param string $type
     *
     * @return $this
     */
    public function setParameter($key, $value, $type = null)
    {
        if (null !== $type) {
            $this->paramTypes[$key] = $type;
        }

        return parent::setParameter($key, $value, $type);
    }

    /**
     * paramTypes is private, we need to redefine setParameters
     * to access it.
     *
     * @return $this
     */
    public function setParameters(array $params, array $types = [])
    {
        $this->paramTypes = $types;

        return parent::setParameters($params, $types);
    }
}
