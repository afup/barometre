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
    #[Route('/report/{reportName}', name: 'afup_barometre_report')]
    public function indexAction(ReportManager $reportManager, Request $request, $reportName): Response
    {
        $reportManager->handleRequest($request);

        $report = $reportManager->getReport($reportName);

        return $this->render('Default/index.html.twig', [
            'form' => $reportManager->getForm()->createView(),
            'report' => $report,
            'report_name' => $reportName,
        ]);
    }
}
