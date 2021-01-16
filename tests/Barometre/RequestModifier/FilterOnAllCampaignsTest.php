<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\RequestModifier;

use Afup\Barometre\RequestModifier\FilterOnAllCampaigns;
use Afup\BarometreBundle\Entity\Campaign;
use Afup\BarometreBundle\Repository\CampaignRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class FilterOnAllCampaignsTest extends TestCase
{
    public function testAlterRequest()
    {
        $request = new Request([]);

        $campaignRepository = $this->prophesize(CampaignRepository::class);
        $campaign = $this->prophesize(Campaign::class);
        $campaign->getId()->willReturn(1);

        $campaignRepository->findAll()->willReturn([$campaign->reveal()]);

        self::assertEquals([], $request->get('filter', []));

        $requestModifier = new FilterOnAllCampaigns($campaignRepository->reveal());
        $requestModifier->alterRequest($request);

        self::assertEquals(['campaign' => [1]], $request->get('filter', []));
    }
}
