<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\JobTitleFilter;
use Afup\BarometreBundle\Enums\JobTitleEnums;

class JobTitleFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new JobTitleFilter(new JobTitleEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['job_title' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['job_title' => [JobTitleEnums::ARCHITECTE]],
            [],
            'SELECT response FROM response WHERE response.jobTitle IN (5)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new JobTitleFilter(new JobTitleEnums());
        $output = $filter->convertValuesToLabels([JobTitleEnums::ARCHITECTE]);

        self::assertEquals(['Architecte'], $output);
    }
}
