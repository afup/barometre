<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\QueryBuilder;

interface FilterInterface
{
    public function buildForm(FormBuilderInterface $builder);

    public function buildQuery(QueryBuilder $queryBuilder, array $values = array());

    public function getName();
}
