<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\SalaryFilter;

class SalaryFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestConvertValuesToLabels
     */
    public function testConvertValuesToLabels(array $input, array $expectedOutput)
    {
        $filter = new SalaryFilter();
        $output = $filter->convertValuesToLabels($input);

        self::assertEquals($expectedOutput, $output);
    }

    public function provideTestConvertValuesToLabels()
    {
        yield 'only min' => [['min' => 15000], ['min' => '>= 15000']];
        yield 'only max' => [['max' => 15000], ['max' => '<= 15000']];
        yield 'both values' => [['min' => 15000, 'max' => 20000], ['min' => '>= 15000', 'max' => '<= 20000']];
        yield 'null max value' => [['min' => 15000, 'max' => null], ['min' => '>= 15000']];
        yield 'null min value' => [['min' => null, 'max' => 15000], ['max' => '<= 15000']];
        yield 'min > max ' => [['min' => 20000, 'max' => 15000], ['min' => '>= 15000', 'max' => '<= 20000']];
    }

    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $input, array $expectedParameters)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new SalaryFilter();

        $filter->buildQuery($queryBuilder, $input);

        self::assertEquals('SELECT response FROM response WHERE (response.grossAnnualSalary >= :minSalary) AND (response.grossAnnualSalary <= :maxSalary)', $queryBuilder->getSQL());
        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
    }

    public function provideTestBuildQuery()
    {
        yield 'normal' => [['salary' => ['min' => 20000, 'max' => 25000]], ['minSalary' => 20000, 'maxSalary' => 25000]];
        yield 'inverted' => [['salary' => ['min' => 25000, 'max' => 20000]], ['minSalary' => 20000, 'maxSalary' => 25000]];
    }
}
