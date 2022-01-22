<?php

declare(strict_types=1);

namespace App\Controller;

use App\ReportManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private ReportManager $reportManager;

    public function __construct(ReportManager $reportManager)
    {
        $this->reportManager = $reportManager;
    }

    #[Route('/report/{reportName}', name: 'afup_barometre_report')]
    public function indexAction(Request $request, $reportName): Response
    {
        $this->reportManager->handleRequest($request);

        $report = $this->reportManager->getReport($reportName);

        return $this->render('Default/index.html.twig', [
            'form' => $this->reportManager->getForm()->createView(),
            'report' => $report,
            'report_name' => $reportName,
        ]);
    }
}
