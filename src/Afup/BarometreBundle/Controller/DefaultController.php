<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Controller;

use Afup\Barometre\ReportManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /** @var ReportManager */
    private $reportManager;

    public function __construct(ReportManager $reportManager)
    {
        $this->reportManager = $reportManager;
    }

    /**
     * @param string $reportName
     *
     * @return Response
     */
    public function indexAction(Request $request, $reportName)
    {
        $this->reportManager->handleRequest($request);

        $report = $this->reportManager->getReport($reportName);

        return $this->render('@AfupBarometre/Default/index.html.twig', [
            'form' => $this->reportManager->getForm()->createView(),
            'report' => $report,
            'report_name' => $reportName,
        ]);
    }
}
