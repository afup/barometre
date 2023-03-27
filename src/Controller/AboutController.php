<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'afup_barometre_about')]
    public function indexAction(CampaignRepository $campaignRepository): Response
    {
        $campaigns = $campaignRepository->findAllOrderedByDate();

        return $this->render('About/index.html.twig', ['campaigns' => $campaigns]);
    }
}
