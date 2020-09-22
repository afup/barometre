<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\MeetupParticipationFilter;
use Afup\BarometreBundle\Enums\MeetupParticipationEnums;

class MeetupParticipationFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new MeetupParticipationFilter(new MeetupParticipationEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['meetup_participation' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['meetup_participation' => [MeetupParticipationEnums::ONE_PER_MONTH]],
            [],
            'SELECT response FROM response WHERE response.meetupParticipation IN (1)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new MeetupParticipationFilter(new MeetupParticipationEnums());
        $output = $filter->convertValuesToLabels([MeetupParticipationEnums::ONE_PER_MONTH]);

        self::assertEquals(['un par mois'], $output);
    }
}
