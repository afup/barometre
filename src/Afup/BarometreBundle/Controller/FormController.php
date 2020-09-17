<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Controller;

use Afup\Barometre\ReportManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    /** @var ReportManager */
    private $reportManager;

    public function __construct(ReportManager $reportManager)
    {
        $this->reportManager = $reportManager;
    }

    /**
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getManager();

        $manager->handleRequest($this->get('request_stack')->getMasterRequest());

        return $this->render('@AfupBarometre/Form/index.html.twig', [
            'form' => $manager->getForm()->createView(),
        ]);
    }

    private function getManager()
    {
        return $this->reportManager;
    }
}
