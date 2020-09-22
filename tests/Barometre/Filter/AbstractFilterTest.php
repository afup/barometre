<?php

declare(strict_types=1);

namespace Afup\Tests\Barometre\Filter;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use PHPUnit\Framework\TestCase;

abstract class AbstractFilterTest extends TestCase
{
    protected function createQueryBuilder(): QueryBuilder
    {
        $connection = $this->prophesize(Connection::class);
        $exprBuilder = new ExpressionBuilder($connection->reveal());
        $connection->getExpressionBuilder()->willReturn($exprBuilder);

        $queryBuilder = new QueryBuilder($connection->reveal());

        $queryBuilder->select('response')->from('response');

        return $queryBuilder;
    }
}
