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

        $query = $this->createQueryInfosFromForm($connection, $context);
        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.compagnyType as companyType');
        $query->addGroupBy('response.compagnyType');

        $results = $query->execute();

        return $this->render('AfupBarometreBundle:Default:index.html.twig', array(
          'results' => $results,
        ));
    }

    protected function createQueryInfosFromForm($connection, $context)
    {
        $query = new \Doctrine\DBAL\Query\QueryBuilder($connection);
        $query->from('response', 'response');

        $params = array();
        $types = array();

        $filterFactory = new \Afup\BarometreBundle\Filter\Factory();
        foreach ($context->getParameters() as $filterIdentifier => $values) {
            if (0 === count($values)) {
                continue;
            }
            $filter = $filterFactory->create($filterIdentifier);
            $filter->alterQuery($query, $values);
        }

        return $query;
    }
}
