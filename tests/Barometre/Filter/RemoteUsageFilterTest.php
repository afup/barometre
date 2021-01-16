<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\RemoteUsageFilter;
use Afup\BarometreBundle\Enums\RemoteUsageEnums;

class RemoteUsageFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new RemoteUsageFilter(new RemoteUsageEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['remote_usage' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['remote_usage' => [RemoteUsageEnums::OFTEN]],
            [],
            'SELECT response FROM response WHERE response.remoteUsage IN (2)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new RemoteUsageFilter(new RemoteUsageEnums());
        $output = $filter->convertValuesToLabels([RemoteUsageEnums::OFTEN]);

        self::assertEquals(['régulièrement'], $output);
    }
}
