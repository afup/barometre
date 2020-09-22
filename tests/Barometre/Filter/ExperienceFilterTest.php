<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\ExperienceFilter;
use Afup\BarometreBundle\Enums\ExperienceEnums;

class ExperienceFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new ExperienceFilter(new ExperienceEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['experience' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['experience' => [ExperienceEnums::XP_2_5]],
            [],
            'SELECT response FROM response WHERE response.experience IN (2)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new ExperienceFilter(new ExperienceEnums());
        $output = $filter->convertValuesToLabels([ExperienceEnums::XP_2_5]);

        self::assertEquals(['2 à 5 ans'], $output);
    }
}
