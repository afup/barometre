<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Campaign;
use App\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampaignController extends AbstractController
{
    private CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    public function formAction(): Response
    {
        return $this->render('Campaign/form.html.twig');
    }

    #[Route('/report/{campaignName}', name: 'afup_barometre_campaign', requirements: ['campaignName' => '\d+'])]
    public function reportAction(Request $request, $campaignName): Response
    {
        $campaign = $this->campaignRepository->findOneBy(['name' => $campaignName]);

        if (!$campaign instanceof Campaign) {
            throw $this->createNotFoundException("La campagne demandée n'existe pas");
        }

        $filter = ['campaign' => [$campaign->getId()]];
        $request->attributes->set('filter', $filter);

        return $this->render(
            'Campaign/report' . $campaignName . '.html.twig',
            [
                'campaignName' => $campaignName,
                'campaignId' => $campaign->getId(),
            ]
        );
    }
}
