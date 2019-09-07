<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Afup\BarometreBundle\Entity\Campaign;

class CampaignController extends Controller
{
    public function formAction()
    {
        return $this->render('AfupBarometreBundle:Campaign:form.html.twig');
    }

    /**
     * @param Request $request
     * @param string  $campaignName
     * @return Response
     */
    public function reportAction(Request $request, $campaignName)
    {
        $campaignRepository = $this->container->get('afup.barometre.repository.campaign_repository');
        $campaign = $campaignRepository->findOneBy(['name' => $campaignName]);

        if ($campaign instanceof Campaign) {
            $filter = ['campaign' => [$campaign->getId()]];
            $request->attributes->set('filter', $filter);
        }

        return $this->render('AfupBarometreBundle:Campaign:report'.$campaignName.'.html.twig');
    }
}
