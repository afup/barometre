<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\DistrictFilter;

class DistrictFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new DistrictFilter();

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['district' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['district' => ['84']],
            ['department' => ['03', '15', '43', '63', '01', '07', '26', '38', '42', '69', '73', '74']],
            'SELECT response FROM response WHERE response.companyDepartment IN(:department)',
        ];
    }

    /**
     * @dataProvider provideTestConvertValuesToLabels
     */
    public function testConvertValuesToLabels(array $input, array $expectedOutput)
    {
        $filter = new DistrictFilter();
        $output = $filter->convertValuesToLabels($input);

        self::assertEquals($expectedOutput, $output);
    }

    public function provideTestConvertValuesToLabels()
    {
        yield [['84'], ['84 - Auvergne-Rhône-Alpes']];
    }
}
