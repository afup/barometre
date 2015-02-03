<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CampaignController extends Controller
{

    public function Form2015Action()
    {
        return $this->render('AfupBarometreBundle:Campaign:form2015.html.twig');
    }
}