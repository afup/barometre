<?php

declare(strict_types=1);

namespace App\Controller;

use App\ReportManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class FormController extends AbstractController
{
    public function indexAction(ReportManager $reportManager, RequestStack $requestStack): Response
    {
        $reportManager->handleRequest($requestStack->getMainRequest());

        return $this->render('Form/index.html.twig', [
            'form' => $this->reportManager->getForm()->createView(),
        ]);
    }
}
