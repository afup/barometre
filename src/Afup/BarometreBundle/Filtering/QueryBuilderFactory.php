<?php

namespace Afup\BarometreBundle\Filtering;

use Doctrine\DBAL\Connection;
use Afup\BarometreBundle\Filter\FilterCollection;

class QueryBuilderFactory
{

    protected $connection;
    protected $context;
    protected $filters;

    public function __construct(Connection $connection, Context $context, FilterCollection $filters)
    {
        $this->connection = $connection;
        $this->context = $context;
        $this->filters = $filters;
    }

    public function getResponse()
    {
        $query = new \Doctrine\DBAL\Query\QueryBuilder($this->connection);
        $query->from('response', 'response');

        foreach ($this->context->getParameters() as $filterIdentifier => $values) {
            if (0 === count($values)) {
                continue;
            }
            $filter = $this->filters->getFilter($filterIdentifier);
            $filter->alterQuery($query, $values);
        }

        return $query;
    }
}
