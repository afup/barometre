<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\SalarySatisfactionFilter;
use Afup\BarometreBundle\Enums\SalarySatisfactionEnums;

class SalarySatisfactionFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new SalarySatisfactionFilter(new SalarySatisfactionEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['salary_satisfaction' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['salary_satisfaction' => [SalarySatisfactionEnums::STATISFAIT]],
            [],
            'SELECT response FROM response WHERE response.salarySatisfaction IN (4)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new SalarySatisfactionFilter(new SalarySatisfactionEnums());
        $output = $filter->convertValuesToLabels([SalarySatisfactionEnums::STATISFAIT]);

        self::assertEquals(['Satisfait'], $output);
    }
}
