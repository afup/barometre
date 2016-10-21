<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    /**
     * @param Request $request
     *
     * @Template
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getManager();

        $manager->handleRequest($this->get('request_stack')->getMasterRequest());

        return [
            'form'   => $manager->getForm()->createView(),
        ];
    }

    private function getManager()
    {
        return $this->get('afup.barometre.manager');
    }
}
