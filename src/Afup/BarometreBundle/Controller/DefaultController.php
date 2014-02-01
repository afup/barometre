<?php

namespace Afup\BarometreBundle\Controller;

class DefaultController
{
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
}
