<?php


namespace Afup\BarometreBundle\Controller;

use Afup\BarometreBundle\Entity\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $campaigns = $this->getCampaignRepository()->findAllOrderedByDate();

        return $this->render('AfupBarometreBundle:About:index.html.twig', ['campaigns' => $campaigns]);
    }

    /**
     * @return CampaignRepository
     */
    private function getCampaignRepository()
    {
        return $this->get('afup.barometre.repository.campaign_repository');
    }
}
