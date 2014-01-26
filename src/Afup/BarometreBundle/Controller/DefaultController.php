<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $query = $this->get('afup.barometre.query_builder_factory')->getResponse();

        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.compagnyType as companyType');
        $query->addGroupBy('response.compagnyType');

        $results = $query->execute();

        return $this->render('AfupBarometreBundle:Default:index.html.twig', array(
          'results' => $results,
        ));
    }
}
