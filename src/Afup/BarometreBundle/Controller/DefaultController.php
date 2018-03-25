<?php

namespace Afup\BarometreBundle\Controller;

use Afup\Barometre\ReportManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @param string  $reportName
     *
     * @Template
     *
     * @return array
     */
    public function indexAction(Request $request, ReportManager $manager, $reportName)
    {
        $manager->handleRequest($request);

        $report = $manager->getReport($reportName);

        return [
            'form' => $manager->getForm()->createView(),
            'report' => $report,
            'report_name' => $reportName,
        ];
    }
}
