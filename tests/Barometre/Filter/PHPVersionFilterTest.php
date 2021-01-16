<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\PHPVersionFilter;
use Afup\BarometreBundle\Enums\PHPVersionEnums;

class PHPVersionFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new PHPVersionFilter(new PHPVersionEnums());

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['php_version' => []], [], 'SELECT response FROM response'];

        yield 'filter defined, with value' => [
            ['php_version' => [PHPVersionEnums::PHP_74]],
            [],
            'SELECT response FROM response WHERE response.phpVersion IN (10)',
        ];
    }

    public function testConvertValuesToLabels()
    {
        $filter = new PHPVersionFilter(new PHPVersionEnums());
        $output = $filter->convertValuesToLabels([PHPVersionEnums::PHP_74]);

        self::assertEquals(['PHP 7.4'], $output);
    }
}
