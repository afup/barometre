<?php

namespace Afup\Barometre;

use Doctrine\DBAL\Connection;
use Symfony\Component\Form\FormInterface;
use Afup\Barometre\Filter\FilterCollection;
use Afup\Barometre\Report\ReportCollection;

/**
 * The Report / Filter Manager
 */
class Manager
{
    private $connection;

    private $form;

    private $reportCollection;

    private $filterCollection;

    /**
     * __construct
     *
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
        $this->connection       = $connection;
        $this->form             = $form;
        $this->reportCollection = $reportCollection;
        $this->filterCollection = $filterCollection;
    }

    /**
     * Get the filter form
     *
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Handle the request
     *
     * @param  Request $request
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

        $queryBuilder = $this->connection->createQueryBuilder();

        $this->filterCollection->buildQuery($queryBuilder, $this->form->getData());

        $report->setQueryBuilder($queryBuilder)

        return $report;
    }
}
