<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportSalaryController extends Controller
{
    public function indexAction()
    {
        $query = $this->get('afup.barometre.query_builder_factory')->getResponse();

        $results = $this->get('afup.barometre.reports.response')->getSalaryReport($query);

        return $this->render('AfupBarometreBundle:Report:salary.html.twig', array(
          'results' => $results,
        ));
    }
}
