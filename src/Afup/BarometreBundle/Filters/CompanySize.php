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

    public function alterQuery(\Doctrine\DBAL\Query\QueryBuilder $query, &$params, &$types, $values)
    {
        $key = $this->getIdentifier();
        $query->andWhere(sprintf('response.compagnySize IN(:%s)', $key));
        $params[$key] = $values;
        $types[$key] = \Doctrine\DBAL\Connection::PARAM_INT_ARRAY;
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
