<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    /**
     * @return Response
     */
    public function form2017Action()
    {
        return $this->render('AfupBarometreBundle:Campaign:form2017.html.twig');
    }

    /**
     * @return Response
     */
    public function report2015Action()
    {
        return $this->render('AfupBarometreBundle:Campaign:report2015.html.twig');
    }

    /**
     * @return Response
     */
    public function report2016Action()
    {
        return $this->render('AfupBarometreBundle:Campaign:report2016.html.twig');
    }
}
