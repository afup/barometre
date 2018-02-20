<?php

namespace Afup\Barometre\Filter\Tests\Units;

use agallou\Departements\Collection;
use atoum;


class SalaryFilter extends atoum
{
    public function testConvertValuesToLabelDisplayOnlySettedValues()
    {
        $salaryFilter = new \Afup\Barometre\Filter\SalaryFilter();
        $this
            ->array($salaryFilter->convertValuesToLabels(['min' => 15000]))
                ->isIdenticalTo(['min' => '>= 15000'])
            ->array($salaryFilter->convertValuesToLabels(['max' => 15000]))
                ->isIdenticalTo(['max' => '<= 15000'])
            ->array($salaryFilter->convertValuesToLabels(['min' => 15000, 'max' => 20000]))
                ->isIdenticalTo(['min' => '>= 15000', 'max' => '<= 20000'])
            ->array($salaryFilter->convertValuesToLabels(['min' => 15000, 'max' => null]))
                ->isIdenticalTo(['min' => '>= 15000'])
            ->array($salaryFilter->convertValuesToLabels(['min' => null, 'max' => 20000]))
                ->isIdenticalTo(['max' => '<= 20000'])
        ;
    }

    public function testConvertValuesCanSwitchValueIfRequired()
    {
        $salaryFilter = new \Afup\Barometre\Filter\SalaryFilter();
        $this
            ->array($salaryFilter->convertValuesToLabels(['min' => 20000, 'max' => 15000]))
            ->isIdenticalTo(['min' => '>= 15000', 'max' => '<= 20000'])
        ;
    }

    public function testBuildQuerySetCorrectParameterForMinAndMaxInNormalCase()
    {
        $salaryFilter = new \Afup\Barometre\Filter\SalaryFilter();
        $mockQueryBuilder = $this->getMockedQueryBuilder();
        $salaryFilter->buildQuery($mockQueryBuilder, ['salary' => ['min' => 20000, 'max' => 25000]]);
        $this
            ->mock($mockQueryBuilder)
                ->call('setParameter')
                    ->withArguments('minSalary', 20000)->once()
                    ->withArguments('maxSalary', 25000)->once()
            ;
    }

    public function testBuildQuerySwitchParameterForMinAndMaxInverted()
    {
        $salaryFilter = new \Afup\Barometre\Filter\SalaryFilter();
        $mockQueryBuilder = $this->getMockedQueryBuilder();
        $salaryFilter->buildQuery($mockQueryBuilder, ['salary' => ['min' => 25000, 'max' => 20000]]);
        $this
            ->mock($mockQueryBuilder)
                ->call('setParameter')
                    ->withArguments('minSalary', 20000)->once()
                    ->withArguments('maxSalary', 25000)->once()
        ;
    }

    protected function getMockedQueryBuilder()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $mock = new \mock\Doctrine\DBAL\Query\QueryBuilder;
        $this
            ->calling($mock)->methodsMatching('/^./')->return = $mock;
        return $mock;
    }

}
