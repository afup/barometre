<?php

namespace Afup\Barometre;

use Afup\Barometre\Filter\FilterCollection;
use Afup\Barometre\Query\QueryBuilder as AfupQueryBuilder;
use Afup\Barometre\Report\ReportCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Connection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Report / Filter Manager
 */
class ReportManager
{
    private $form;

    private $reportCollection;

    private $filterCollection;

    private $connection;

    /**
     * @param Connection       $connection
     * @param FormInterface    $form
     * @param ReportCollection $reportCollection
     * @param FilterCollection $filterCollection
     */
    public function __construct(
        Connection $connection,
        FormInterface $form,
        ReportCollection $reportCollection,
        FilterCollection $filterCollection
    ) {
        $this->connection = $connection;
        $this->form             = $form;
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
     * Handle the request
     *
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {
        $this->form->handleRequest($request);
    }

    /**
     * Get current selected filters
     */
    public function getSelectedFilters()
    {
        $filters = $this->form->getData();
        $filters = array_filter($filters, array($this, 'filterValues'));
        $filters = $this->filterCollection->convertValuesToLabels($filters);

        return $filters;
    }

    /**
     * Internal cleaning function for form filter data
     *
     * @param mixed $value
     *
     * @return boolean
     */
    protected function filterValues($value)
    {
        if (is_array($value)) {
            $value = array_filter($value, array($this, 'filterValues'));

            $keepValue = count($value) > 0;
        } elseif ($value instanceof Collection) {
            $keepValue = !$value->isEmpty();
        } else {
            $keepValue = null !== $value;
        }

        return $keepValue;
    }

    /**
     * Find a report and set the querybuilder
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

        $data = (array) $this->form->getData();

        $filterTableBuilder = new AfupQueryBuilder($this->connection);

        $filterTableBuilder
            ->from('response', 'response')
            ->select('response.id as response_id')
            ->groupBy('response_id')
        ;

        $this->filterCollection->buildQuery($filterTableBuilder, $data);

        $temporaryTablename = sprintf('tmp_%s', md5(serialize($data)));
        $filterTableBuilder->dropTemporaryTable($temporaryTablename);
        $filterTableBuilder->createTemporaryTable($temporaryTablename);

        $reportQueryBuilder = $this->connection->createQueryBuilder();
        $reportQueryBuilder
            ->from('response', 'response')
            ->join('response', $temporaryTablename, 'filter_table', 'response.id = filter_table.response_id')
        ;

        $report->setQueryBuilder($reportQueryBuilder);

        return $report;
    }
}
