<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
    public function indexAction(Request $request, $reportName)
    {
        $manager = $this->getManager();

        $manager->handleRequest($request);

        $report = $manager->getReport($reportName);

        return [
            'form'   => $manager->getForm()->createView(),
            'filters' => $manager->getSelectedFilters(),
            'report' => $report,
            'has_result' => $manager->hasResults(),
        ];
    }

    private function getManager()
    {
        return $this->get('afup.barometre.manager');
    }
}
