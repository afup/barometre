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
     * @var array
     */
    protected $paramTypes = array();

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

        $this->connection->executeUpdate($sql, $this->getParameters(), $this->paramTypes);
    }

    /**
     * @param string $tablename
     */
    public function dropTemporaryTable($tablename)
    {
        $sql = sprintf('DROP TEMPORARY TABLE IF EXISTS `%s`', $tablename);

        $this->connection->executeUpdate($sql);
    }


    /**
     * paramTypes is private, we need to redefine setParameter
     * to access it
     *
     * @param string $key
     * @param string $value
     * @param string $type
     *
     * @return $this
     */
    public function setParameter($key, $value, $type = null)
    {
        if ($type !== null) {
            $this->paramTypes[$key] = $type;
        }

        return parent::setParameter($key, $value, $type);
    }

    /**
     * paramTypes is private, we need to redefine setParameters
     * to access it
     *
     * @param array $params
     * @param array $types
     *
     * @return $this
     */
    public function setParameters(array $params, array $types = array())
    {
        $this->paramTypes = $types;

        return parent::setParameters($params, $types);
    }
}
