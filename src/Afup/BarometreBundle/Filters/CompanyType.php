<?php

namespace Afup\BarometreBundle\Filters;

use \Afup\BarometreBundle\Filter\FilterInterface;

class CompanyType implements FilterInterface
{

    public function getChoices()
    {
        $enum = new \Afup\BarometreBundle\Enums\CompanyTypeEnums();
        return $enum->getChoices();
    }

    public function alterQuery(\Doctrine\DBAL\Query\QueryBuilder $query, $values)
    {
        $key = $this->getIdentifier();
        $query->andWhere(sprintf('response.compagnyType IN(:%s)', $key));
        $query->setParameter($key, $values, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
    }

    public function getIdentifier()
    {
        return 'company_type';
    }

    public function getLabel()
    {
        return "Type d'entreprise";
    }
}
