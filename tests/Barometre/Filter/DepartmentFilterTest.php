<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\DepartmentFilter;

class DepartmentFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new DepartmentFilter();

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['departement' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['departement' => ['07']],
            ['department' => ['07']],
            'SELECT response FROM response WHERE response.companyDepartment IN(:department)',
        ];

        yield 'filter defined, with special value all_but_paris' => [
            ['departement' => ['all_but_paris']],
            ['department' => ['01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, '2A', '2B', 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 76, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 971, 972, 973, 974, 976]],
            'SELECT response FROM response WHERE response.companyDepartment IN(:department)',
        ];
    }

    /**
     * @dataProvider provideTestConvertValuesToLabels
     */
    public function testConvertValuesToLabels(array $input, array $expectedOutput)
    {
        $filter = new DepartmentFilter();
        $output = $filter->convertValuesToLabels($input);

        self::assertEquals($expectedOutput, $output);
    }

    public function provideTestConvertValuesToLabels()
    {
        yield [['07'], ['07 - Ardèche']];
        yield [['all_but_paris'], ['Tous sauf île-de-France']];
    }
}
