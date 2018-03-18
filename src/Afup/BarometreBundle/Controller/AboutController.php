<?php

namespace Afup\BarometreBundle\Controller;

use Afup\BarometreBundle\Entity\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    /**
     * @param CampaignRepository $campaignRepository
     *
     * @return Response
     */
    public function indexAction(CampaignRepository $campaignRepository)
    {
        $campaigns = $campaignRepository->findAllOrderedByDate();

        return $this->render('@AfupBarometre/About/index.html.twig', ['campaigns' => $campaigns]);
    }
}
