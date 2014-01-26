<?php

namespace Afup\BarometreBundle\Filter;

interface FilterInterface
{
    public function getChoices();
    public function alterQuery(\Doctrine\DBAL\Query\QueryBuilder $query, &$params, &$types, $values);
    public function getIdentifier();
    public function getLabel();
}
