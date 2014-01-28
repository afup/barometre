<?php

namespace Afup\BarometreBundle\Filter;

interface FilterInterface
{
    public function getChoices();
    public function alterQuery(\Doctrine\DBAL\Query\QueryBuilder $query, $values);
    public function getIdentifier();
    public function getLabel();
}
