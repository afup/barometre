<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afup\BarometreBundle\Form\Type\FilteringType;

class FiltersController extends Controller
{
    public function indexAction()
    {
        $context = $this->get('afup.barometre.context');

        $form = $this->createForm(new FilteringType(), null, array(
          'filters' => $this->get('afup.barometre.filter_collection')->getAll(),
        ));
        $form->submit($context->getParameters());

        return $this->render('AfupBarometreBundle:Filters:index.html.twig', array(
          'form'    => $form->createView(),
        ));
    }
}
