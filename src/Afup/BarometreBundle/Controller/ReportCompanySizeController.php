<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportCompanySizeController extends Controller
{
    public function indexAction()
    {
        $query = $this->get('afup.barometre.query_builder_factory')->getResponse();

        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.compagnySize as companySize');
        $query->addGroupBy('response.compagnySize');

        $results = $query->execute();

        return $this->render('AfupBarometreBundle:Report:company_size.html.twig', array(
          'results' => $results,
        ));
    }
}
