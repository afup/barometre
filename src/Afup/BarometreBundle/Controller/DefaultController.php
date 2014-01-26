<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afup\BarometreBundle\Form\Type\FilteringType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $connection = $this->getDoctrine()->getConnection();
        $context = $this->get('afup.barometre.context');

        $qbF = new \Afup\BarometreBundle\Filtering\QueryBuilderFactory($connection, $context);
        $query = $qbF->getResponse();

        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.compagnyType as companyType');
        $query->addGroupBy('response.compagnyType');

        $results = $query->execute();

        return $this->render('AfupBarometreBundle:Default:index.html.twig', array(
          'results' => $results,
        ));
    }
}
