<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afup\BarometreBundle\Form\Type\FilteringType;

class FiltersController extends Controller
{
    public function indexAction()
    {
        $filters    = \Afup\BarometreBundle\Filter\Collection::getAll();
        $connection = $this->getDoctrine()->getConnection();

        $context = $this->get('afup.barometre.context');

        $form = $this->createForm(new FilteringType(), null, array(
          'filters' => $filters
        ));
        $form->submit($context->getParameters());

        return $this->render('AfupBarometreBundle:Filters:index.html.twig', array(
          'form'    => $form->createView(),
        ));
    }
}
