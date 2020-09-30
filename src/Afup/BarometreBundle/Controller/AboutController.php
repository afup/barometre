<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Controller;

use Afup\BarometreBundle\Entity\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends Controller
{
    /** @var CampaignRepository */
    private $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @Route(name="afup_barometre_about", path="/about")
     *
     * @return Response
     */
    public function indexAction()
    {
        $campaigns = $this->campaignRepository->findAllOrderedByDate();

        return $this->render('AfupBarometreBundle:About:index.html.twig', ['campaigns' => $campaigns]);
    }
}
