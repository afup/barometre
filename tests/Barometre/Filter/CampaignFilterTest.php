<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\CampaignFilter;
use Afup\BarometreBundle\Entity\Campaign;
use Doctrine\Common\Collections\ArrayCollection;

class CampaignFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new CampaignFilter();

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['campaign' => []], [], 'SELECT response FROM response'];

        $campaign = $this->prophesize(Campaign::class);
        $campaign->getId()->willReturn(1);

        yield 'filter defined, with value' => [
            ['campaign' => new ArrayCollection([$campaign->reveal()])],
            [],
            'SELECT response FROM response WHERE response.campaign_id IN (1)',
        ];
    }
}
