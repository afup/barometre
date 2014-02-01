<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

interface ReportInterface
{
    function setQueryBuilder(QueryBuilder $queryBuilder);

    function getData();

    function getName();
}
