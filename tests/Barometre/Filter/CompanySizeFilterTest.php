<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\CompanySizeFilter;
use Afup\BarometreBundle\Enums\CompanySizeEnums;

class CompanySizeFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new CompanySizeFilter(new CompanySizeEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['company_size' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['company_size' => [CompanySizeEnums::DE_10_A_49]],
            [],
            'SELECT response FROM response WHERE response.companySize IN (2)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new CompanySizeFilter(new CompanySizeEnums());
        $output = $filter->convertValuesToLabels([CompanySizeEnums::DE_50_A_199]);

        self::assertEquals(['De 50 à 199 salariés'], $output);
    }
}
