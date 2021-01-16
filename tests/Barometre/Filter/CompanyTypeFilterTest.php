<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\CompanyTypeFilter;
use Afup\BarometreBundle\Enums\CompanyTypeEnums;

class CompanyTypeFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new CompanyTypeFilter(new CompanyTypeEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['company_type' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['company_type' => [CompanyTypeEnums::AGENCE_WEB]],
            [],
            'SELECT response FROM response WHERE response.companyType IN (7)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new CompanyTypeFilter(new CompanyTypeEnums());
        $output = $filter->convertValuesToLabels([CompanyTypeEnums::AGENCE_WEB]);

        self::assertEquals(['Agence Web'], $output);
    }
}
