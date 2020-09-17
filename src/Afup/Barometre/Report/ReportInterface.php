<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * A report
 */
interface ReportInterface
{
    /**
     * Inject the Query updated with filter
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

    /**
     * The report has results
     *
     * @return bool
     */
    public function hasResults();

    /**
     * Execute the report
     */
    public function execute();

    /**
     * @return int|null
     */
    public function getWeight();

    /**
     * @return ReportInterface[]
     */
    public function getChildReports();

    /**
     * @return ReportInterface[]
     */
    public function setChildReports(array $childReports);
}
