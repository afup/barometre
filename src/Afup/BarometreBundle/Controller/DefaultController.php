<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afup\BarometreBundle\Form\Type\FilteringType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $filters    = \Afup\BarometreBundle\Filter\Collection::getAll();
        $connection = $this->getDoctrine()->getConnection();

        $form = $this->createForm(new FilteringType(), null, array(
          'filters' => $filters
        ));
        $form->handleRequest($this->getRequest());

        $queryInfos = $this->createQueryInfosFromForm($connection, $form);
        $query = $queryInfos['query'];
        $query->select('grossAnnualSalary');

        $results = $connection->executeQuery($query->getSQL(), $queryInfos['params'], $queryInfos['types']);

        return $this->render('AfupBarometreBundle:Default:index.html.twig', array(
          'results' => $results,
          'form'    => $form->createView(),
        ));
    }

    protected function createQueryInfosFromForm($connection, $form) {
        $query = new \Doctrine\DBAL\Query\QueryBuilder($connection);
        $query->from('response', 'response');

        $params = array();
        $types = array();

        $filterFactory = new \Afup\BarometreBundle\Filter\Factory();
        if ($form->isValid()) {
            foreach ($form->getData() as $filterIdentifier => $values) {
              if (0 === count($values)) {
                continue;
              }
              $filter = $filterFactory->create($filterIdentifier);
              $filter->alterQuery($query, $params, $types, $values);
            }
        }
        return array('query' => $query, 'params' => $params, 'types' => $types);
    }
}
