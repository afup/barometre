<?php


namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{

    public function indexAction()
    {
        return $this->render('AfupBarometreBundle:About:index.html.twig');
    }
}
