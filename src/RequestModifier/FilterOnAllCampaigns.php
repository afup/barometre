<?php

declare(strict_types=1);

namespace App\RequestModifier;

use App\Repository\CampaignRepository;
use Symfony\Component\HttpFoundation\Request;

class FilterOnAllCampaigns implements RequestModifierInterface
{
    private CampaignRepository $campaignRepository;

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
        foreach ($this->campaignRepository->findAll() as $campaign) {
            $campaignIds[] = $campaign->getId();
        }

        $filter = $request->get('filter', []);
        $filter['campaign'] = $campaignIds;
        $request->query->set('filter', $filter);
    }
}
