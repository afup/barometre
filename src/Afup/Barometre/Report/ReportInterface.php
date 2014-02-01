<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * A report
 */
interface ReportInterface
{
    /**
     * Inject the Query updated with filter
     *
     * @param QueryBuilder $queryBuilder
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder);

    /**
     * Process the query
     *
     * @return array
     */
    public function getData();

    /**
     * The report name (used for url)
     *
     * @return string
     */
    public function getName();

    /**
     * The report label (used for title & menu)
     *
     * @return string
     */
    public function getLabel();
}
