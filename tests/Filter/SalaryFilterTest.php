<?php

declare(strict_types=1);

namespace App\Tests\Filter;

use App\Filter\SalaryFilter;
use Doctrine\DBAL\Query\QueryBuilder;
use PHPUnit\Framework\TestCase;

class SalaryFilterTest extends TestCase
{
    public function testConvertValuesToLabelDisplayOnlySettedValues(): void
    {
        $salaryFilter = new SalaryFilter();

        $this->assertSame(['min' => '>= 15000'], $salaryFilter->convertValuesToLabels(['min' => 15000]));
        $this->assertSame(['max' => '<= 15000'], $salaryFilter->convertValuesToLabels(['max' => 15000]));
        $this->assertSame(['min' => '>= 15000', 'max' => '<= 20000'], $salaryFilter->convertValuesToLabels(['min' => 15000, 'max' => 20000]));
        $this->assertSame(['min' => '>= 15000'], $salaryFilter->convertValuesToLabels(['min' => 15000, 'max' => null]));
        $this->assertSame(['max' => '<= 20000'], $salaryFilter->convertValuesToLabels(['min' => null, 'max' => 20000]));
    }

    public function testConvertValuesCanSwitchValueIfRequired(): void
    {
        $salaryFilter = new SalaryFilter();

        $this->assertSame(
            ['min' => '>= 15000', 'max' => '<= 20000'],
            $salaryFilter->convertValuesToLabels(['min' => 20000, 'max' => 15000])
        );
    }

    public function testBuildQuerySetCorrectParameterForMinAndMaxInNormalCase(): void
    {
        $salaryFilter = new SalaryFilter();
        $queryBuilder = $this->createMock(QueryBuilder::class);

        $queryBuilder->expects($this->any())
            ->method('expr')
            ->willReturn(new \Doctrine\DBAL\Query\Expression\ExpressionBuilder($this->createMock(\Doctrine\DBAL\Connection::class)));

        $queryBuilder->expects($this->any())
            ->method('andWhere')
            ->willReturnSelf();

        $queryBuilder->expects($this->exactly(2))
            ->method('setParameter')
            ->willReturnCallback(function ($key, $value) use ($queryBuilder) {
                static $calls = [];
                $calls[$key] = $value;

                if (2 === \count($calls)) {
                    $this->assertSame(20000, $calls['minSalary']);
                    $this->assertSame(25000, $calls['maxSalary']);
                }

                return $queryBuilder;
            });

        $salaryFilter->buildQuery($queryBuilder, ['salary' => ['min' => 20000, 'max' => 25000]]);
    }

    public function testBuildQuerySwitchParameterForMinAndMaxInverted(): void
    {
        $salaryFilter = new SalaryFilter();
        $queryBuilder = $this->createMock(QueryBuilder::class);

        $queryBuilder->expects($this->any())
            ->method('expr')
            ->willReturn(new \Doctrine\DBAL\Query\Expression\ExpressionBuilder($this->createMock(\Doctrine\DBAL\Connection::class)));

        $queryBuilder->expects($this->any())
            ->method('andWhere')
            ->willReturnSelf();

        $queryBuilder->expects($this->exactly(2))
            ->method('setParameter')
            ->willReturnCallback(function ($key, $value) use ($queryBuilder) {
                static $calls = [];
                $calls[$key] = $value;

                if (2 === \count($calls)) {
                    $this->assertSame(20000, $calls['minSalary']);
                    $this->assertSame(25000, $calls['maxSalary']);
                }

                return $queryBuilder;
            });

        $salaryFilter->buildQuery($queryBuilder, ['salary' => ['min' => 25000, 'max' => 20000]]);
    }
}
