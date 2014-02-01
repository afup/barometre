<?php

namespace Afup\Barometre;

use Doctrine\DBAL\Connection;
use Symfony\Component\Form\FormInterface;
use Afup\Barometre\Filter\FilterCollection;
use Afup\Barometre\Report\ReportCollection;

class Manager
{
    private $connection;

    private $form;

    private $reportCollection;

    private $filterCollection;

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

    public function getForm()
    {
        return $this->form;
    }

    public function handleRequest(Request $request)
    {
        $this->form->handleRequest($request);
    }

    public function getReport($reportName)
    {
        $report = $this->reportCollection->getReport($reportName);

        $queryBuilder = $this->connection->createQueryBuilder();

        $this->filterCollection->buildQuery($queryBuilder, $this->form->getData());

        $report->setQueryBuilder($queryBuilder)

        return $report;
    }
}
