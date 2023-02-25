<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Campaign;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampaignController extends AbstractController
{
    public function formAction(): Response
    {
        return $this->render('Campaign/form.html.twig');
    }

    #[Route(
        path: '/report/{campaignName}',
        name: 'afup_barometre_campaign',
        requirements: ['campaignName' => '\d+'],
    )]
    public function reportAction(
        Request $request,
        #[MapEntity(mapping: ['campaignName' => 'name'])]
        Campaign $campaign,
    ): Response {
        $filter = ['campaign' => [$campaign->getId()]];
        $request->attributes->set('filter', $filter);

        return $this->render(
            'Campaign/report' . $campaign->getName() . '.html.twig',
            [
                'campaignName' => $campaign->getName(),
                'campaignId' => $campaign->getId(),
            ]
        );
    }
}
