<?php

namespace Afup\BarometreBundle\Filters;

use \Afup\BarometreBundle\Filter\FilterInterface;

class CompanySize implements FilterInterface
{

    public function getChoices()
    {
        $enum = new \Afup\BarometreBundle\Enums\CompanySizeEnums();
        return $enum->getChoices();
    }

    public function alterQuery(\Doctrine\DBAL\Query\QueryBuilder $query, $values)
    {
        $key = $this->getIdentifier();
        $query->andWhere(sprintf('response.companySize IN(:%s)', $key));
        $query->setParameter($key, $values, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
    }

    public function getIdentifier()
    {
        return 'company_size';
    }

    public function getLabel()
    {
        return "Taille de l'entreprise";
    }
}
