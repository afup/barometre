<?php

namespace Afup\Barometre;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Afup\Barometre\Filter\FilterCollection;
use Afup\Barometre\Report\ReportCollection;

/**
 * The Report / Filter Manager
 */
class ReportManager
{
    private $objectManager;

    private $form;

    private $reportCollection;

    private $filterCollection;

    /**
     * @param EntityManagerInterface $objectManager
     * @param FormInterface          $form
     * @param ReportCollection       $reportCollection
     * @param FilterCollection       $filterCollection
     */
    public function __construct(
        EntityManagerInterface $objectManager,
        FormInterface $form,
        ReportCollection $reportCollection,
        FilterCollection $filterCollection
    ) {
        $this->objectManager    = $objectManager;
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

        $queryBuilder = $this->objectManager->createQueryBuilder();

        $queryBuilder
            ->from('AfupBarometreBundle:Response', 'response')
            ->leftJoin('response.specialities', 'speciality')
            ->leftJoin('response.certifications', 'certification');

        $this->filterCollection->buildQuery($queryBuilder, (array) $this->form->getData());

        if (!$report) {
            // exception
            return;
        }

        $report->setQueryBuilder($queryBuilder);

        return $report;
    }
}
