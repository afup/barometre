<?php

namespace Afup\BarometreBundle\EventListener;

use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Entity\CampaignRepository;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\Router;

/**
 * Class CampaignReportRequestListener
 * @package Afup\BarometreBundle\EventListener
 */
class CampaignReportRequestListener
{
    /**
     * @var CampaignRepository
     */
    private $campaignRepository;

    /**
     * @var Router
     */
    private $router;

    /**
     * CampaignReportRequestListener constructor.
     * @param CampaignRepository $campaignRepository
     * @param Router             $router
     */
    public function __construct(CampaignRepository $campaignRepository, Router $router)
    {
        $this->campaignRepository = $campaignRepository;
        $this->router = $router;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $routeName = $request->get('_route');
        $route = $this->router->getRouteCollection()->get($routeName);
        $campaignYear = $route->getOption('campaign_year');

        if (is_null($campaignYear)) {
            return;
        }

        $campaign = $this->campaignRepository->findOneBy(['name' => $campaignYear]);
        if ($campaign instanceof Campaign) {
            $filter = ['campaign' => [$campaign->getId()]];
            $request->attributes->set('filter', $filter);
        }

    }
}
