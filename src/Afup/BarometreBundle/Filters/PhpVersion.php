<?php

namespace Afup\BarometreBundle\Filters;

use \Afup\BarometreBundle\Filter\FilterInterface;

class PhpVersion implements FilterInterface
{

    public function getChoices()
    {
        $enum = new \Afup\BarometreBundle\Enums\PHPVersionEnums();
        return $enum->getChoices();
    }

    public function alterQuery(\Doctrine\DBAL\Query\QueryBuilder $query, $values)
    {
        $key = $this->getIdentifier();
        $query->andWhere(sprintf('response.phpVersion IN(:%s)', $key));
        $query->setParameter($key, $values, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
    }

    public function getIdentifier()
    {
        return 'php_version';
    }

    public function getLabel()
    {
        return "Version de PHP";
    }
}
