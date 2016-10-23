<?php

namespace Afup\Barometre\RequestModifier;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class FilterOnAllCampaigns implements RequestModifierInterface
{
    /**
     * @var Doctrine
     */
    protected $doctrine;

    /**
     * @param Doctrine $doctrine
     */
    public function __construct(Doctrine $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'filter_on_all_campaigns';
    }

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request)
    {
        $campaignIds = [];
        $campaignRepository = $this->doctrine->getManager()->getRepository('AfupBarometreBundle:Campaign');
        foreach ($campaignRepository->findAll() as $campaign) {
            $campaignIds[] = $campaign->getId();
        }

        $filter = $request->get('filter', []);
        $filter['campaign'] = $campaignIds;
        $request->query->set('filter', $filter);
    }
}
