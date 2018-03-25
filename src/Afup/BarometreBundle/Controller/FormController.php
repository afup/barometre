<?php

namespace Afup\BarometreBundle\Controller;

use Afup\Barometre\ReportManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function indexAction(Request $request, ReportManager $manager)
    {
        $manager->handleRequest($this->get('request_stack')->getMasterRequest());

        return [
            'form' => $manager->getForm()->createView(),
        ];
    }
}
