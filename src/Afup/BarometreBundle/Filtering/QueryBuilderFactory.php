<?php

namespace Afup\BarometreBundle\Filtering;

use Doctrine\DBAL\Connection;

class QueryBuilderFactory
{

    protected $connection;
    protected $context;

    public function __construct(Connection $connection, Context $context)
    {
        $this->connection = $connection;
        $this->context = $context;
    }

    public function getResponse()
    {
        $query = new \Doctrine\DBAL\Query\QueryBuilder($this->connection);
        $query->from('response', 'response');

        $filterFactory = new \Afup\BarometreBundle\Filter\Factory();
        foreach ($this->context->getParameters() as $filterIdentifier => $values) {
            if (0 === count($values)) {
                continue;
            }
            $filter = $filterFactory->create($filterIdentifier);
            $filter->alterQuery($query, $values);
        }

        return $query;
    }
}
