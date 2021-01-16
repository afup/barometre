<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\GenderFilter;
use Afup\BarometreBundle\Enums\GenderEnums;

class GenderFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new GenderFilter(new GenderEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['gender' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['gender' => [GenderEnums::MALE]],
            [],
            'SELECT response FROM response WHERE response.gender = 1',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new GenderFilter(new GenderEnums());
        $output = $filter->convertValuesToLabels([GenderEnums::MALE]);

        self::assertEquals(['Hommes'], $output);
    }
}
