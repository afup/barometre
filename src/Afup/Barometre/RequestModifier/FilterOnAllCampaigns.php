<?php

declare(strict_types=1);

namespace Afup\Barometre\RequestModifier;

use Afup\BarometreBundle\Repository\CampaignRepository;
use Symfony\Component\HttpFoundation\Request;

class FilterOnAllCampaigns implements RequestModifierInterface
{
    /** @var CampaignRepository */
    private $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
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
        $campaigns = $this->campaignRepository->findAll();
        foreach ($campaigns as $campaign) {
            $campaignIds[] = $campaign->getId();
        }

        $filter = $request->get('filter', []);
        $filter['campaign'] = $campaignIds;
        $request->query->set('filter', $filter);
    }
}
