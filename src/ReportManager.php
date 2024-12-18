<?php

declare(strict_types=1);

namespace App;

use App\Filter\FilterCollection;
use App\Query\QueryBuilder as AfupQueryBuilder;
use App\Report\ReportCollection;
use App\Report\ReportInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Connection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ReportManager
{
    private FormInterface $form;
    private ReportCollection $reportCollection;
    private FilterCollection $filterCollection;
    private Connection $connection;

    public function __construct(
        Connection $connection,
        FormInterface $form,
        ReportCollection $reportCollection,
        FilterCollection $filterCollection,
    ) {
        $this->connection = $connection;
        $this->form = $form;
        $this->reportCollection = $reportCollection;
        $this->filterCollection = $filterCollection;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Handle the request.
     */
    public function handleRequest(Request $request)
    {
        $this->form->handleRequest($request);
    }

    /**
     * Get current selected filters.
     */
    public function getSelectedFilters()
    {
        $filters = $this->form->getData();
        $filters = array_filter((array) $filters, [$this, 'filterValues']);
        $filters = $this->filterCollection->convertValuesToLabels($filters);

        return $filters;
    }

    /**
     * Internal cleaning function for form filter data.
     *
     * @return bool
     */
    protected function filterValues($value)
    {
        if (\is_array($value)) {
            $value = array_filter($value, [$this, 'filterValues']);

            $keepValue = \count($value) > 0;
        } elseif ($value instanceof Collection) {
            $keepValue = !$value->isEmpty();
        } else {
            $keepValue = null !== $value;
        }

        return $keepValue;
    }

    /**
     * Find a report and set the querybuilder.
     *
     * @param string $reportName
     *
     * @return ReportInterface
     */
    public function getReport($reportName)
    {
        $report = $this->reportCollection->getReport($reportName);

        if (!$report) {
            // exception
            return;
        }

        $reportQueryBuilder = $this->createBaseQueryBuilder();

        $report->setQueryBuilder($reportQueryBuilder);

        return $report;
    }

    /**
     * @return int
     */
    public function hasResults()
    {
        $reportQueryBuilder = $this->createBaseQueryBuilder();

        $reportQueryBuilder->addSelect('count(response.id) as nb_results');

        $row = $reportQueryBuilder->fetchAssociative();

        return $row['nb_results'];
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function createBaseQueryBuilder()
    {
        $data = (array) $this->form->getData();

        $filterTableBuilder = new AfupQueryBuilder($this->connection);

        $filterTableBuilder
            ->from('response', 'response')
            ->select('response.id as response_id')
            ->groupBy('response_id')
        ;

        $this->filterCollection->buildQuery($filterTableBuilder, $data);

        $temporaryTablename = \sprintf('tmp_%s', md5(serialize($data)));
        $filterTableBuilder->dropTemporaryTable($temporaryTablename);
        $filterTableBuilder->createTemporaryTable($temporaryTablename);

        $reportQueryBuilder = $this->connection->createQueryBuilder();
        $reportQueryBuilder
            ->from('response', 'response')
            ->join('response', $temporaryTablename, 'filter_table', 'response.id = filter_table.response_id')
        ;

        return $reportQueryBuilder;
    }

    public function __clone()
    {
        $this->form = clone $this->form;
    }
}
