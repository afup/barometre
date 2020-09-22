<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Controller;

use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    /** @var CampaignRepository */
    private $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    public function formAction()
    {
        return $this->render('@AfupBarometre/Campaign/form.html.twig');
    }

    /**
     * @param string $campaignName
     *
     * @return Response
     */
    public function reportAction(Request $request, $campaignName)
    {
        $campaign = $this->campaignRepository->findOneBy(['name' => $campaignName]);

        if (!$campaign instanceof Campaign) {
            throw $this->createNotFoundException("La campagne demandée n'existe pas");
        }

        $filter = ['campaign' => [$campaign->getId()]];
        $request->attributes->set('filter', $filter);

        return $this->render(
            '@AfupBarometre/Campaign/report' . $campaignName . '.html.twig',
            [
                'campaignName' => $campaignName,
                'campaignId' => $campaign->getId(),
            ]
        );
    }
}
