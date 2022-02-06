<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    private CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    #[Route('/about', name: 'afup_barometre_about')]
    public function indexAction(): Response
    {
        $campaigns = $this->campaignRepository->findAllOrderedByDate();

        return $this->render('About/index.html.twig', ['campaigns' => $campaigns]);
    }
}
