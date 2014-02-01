<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

interface ReportInterface
{
    public function setQueryBuilder(QueryBuilder $queryBuilder);

    public function getData();

    public function getName();
}
