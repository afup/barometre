<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\StatusFilter;
use Afup\BarometreBundle\Enums\StatusEnums;

class StatusFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new StatusFilter(new StatusEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['status' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['status' => [StatusEnums::CDI]],
            [],
            'SELECT response FROM response WHERE response.status IN (2)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new StatusFilter(new StatusEnums());
        $output = $filter->convertValuesToLabels([StatusEnums::CDI]);

        self::assertEquals(['Contrat à durée indéterminée'], $output);
    }
}
