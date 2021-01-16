<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Afup\Barometre\Filter\CertificationFilter;
use Afup\BarometreBundle\Entity\Certification;
use Doctrine\Common\Collections\ArrayCollection;

class CertificationFilterTest extends AbstractFilterTest
{
    /**
     * @dataProvider provideTestBuildQuery
     */
    public function testBuildQuery(array $inputValues, array $expectedParameters, string $expectedSQLQuery)
    {
        $queryBuilder = $this->createQueryBuilder();
        $filter = new CertificationFilter();

        $filter->buildQuery($queryBuilder, $inputValues);

        self::assertEquals($expectedParameters, $queryBuilder->getParameters());
        self::assertEquals($expectedSQLQuery, $queryBuilder->getSQL());
    }

    public function provideTestBuildQuery()
    {
        yield 'filter not defined' => [[], [], 'SELECT response FROM response'];
        yield 'filter defined, no value' => [['certifications' => []], [], 'SELECT response FROM response'];

        $certification = $this->prophesize(Certification::class);
        $certification->getId()->willReturn(1);

        yield 'filter defined, with value' => [
            ['certifications' => new ArrayCollection([$certification->reveal()])],
            [],
            'SELECT response FROM response LEFT JOIN response_certification response_certification ON response.id = response_certification.response_id WHERE response_certification.certification_id IN (1)',
        ];
    }
}
