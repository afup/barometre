<?php

declare(strict_types=1);

namespace Afup\Barometre\RequestModifier;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpFoundation\Request;

class FilterOnAllCampaigns implements RequestModifierInterface
{
    /**
     * @var Doctrine
     */
    protected $doctrine;

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
