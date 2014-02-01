<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\QueryBuilder;

interface FilterInterface
{
    function buildForm(FormBuilderInterface $builder);

    function buildQuery(QueryBuilder $queryBuilder, array $values = array());

    function getName();
}
