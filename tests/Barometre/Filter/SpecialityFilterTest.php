<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\SpecialityFilter;
use Afup\BarometreBundle\Entity\Speciality;
use Doctrine\Common\Collections\ArrayCollection;

class SpecialityFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new SpecialityFilter();

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['specialities' => []], [], 'SELECT response FROM response'];

        $speciality = $this->prophesize(Speciality::class);
        $speciality->getId()->willReturn(1);

        yield 'filter defined, with value' => [
            ['specialities' => new ArrayCollection([$speciality->reveal()])],
            [],
            'SELECT response FROM response INNER JOIN response_speciality response_speciality ON response.id = response_speciality.response_id INNER JOIN speciality speciality ON response_speciality.speciality_id = speciality.id WHERE speciality.id IN (1)',
        ];
    }
}
