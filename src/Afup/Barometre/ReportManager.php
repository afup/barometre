<?php

namespace Afup\Barometre;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Afup\Barometre\Filter\FilterCollection;
use Afup\Barometre\Report\ReportCollection;
use Afup\Barometre\Query\QueryBuilder as AfupQueryBuilder;

/**
 * The Report / Filter Manager
 */
class ReportManager
{
    private $objectManager;

    private $form;

    private $reportCollection;

    private $filterCollection;

    private $connection;

    /**
     * @param EntityManagerInterface $objectManager
     * @param FormInterface          $form
     * @param ReportCollection       $reportCollection
     * @param FilterCollection       $filterCollection
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
