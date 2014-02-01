<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param  Request $request
     * @param  string  $reportName
     *
     * @Template
     *
     * @return array
     */
    public function indexAction(Request $request, $reportName)
    {
        $manager = $this->getManager();

        $manager->handleRequest($request);

        $report = $manager->getReport($reportName);

        return [
            'form'   => $manager->getForm()->createView(),
            'report' => $report
        ];
    }

    public function reportsAction()
    {
        return [

        ]
    }

    private function getManager()
    {
        return $this->get('afup.barometre.manager');
    }
}
