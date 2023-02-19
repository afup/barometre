<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Salary Filter Type
 */
class SalaryFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('min', IntegerType::class, ['required' => false, 'attr' => ['placeholder' => 'filter.salary.min']])
            ->add('max', IntegerType::class, ['required' => false, 'attr' => ['placeholder' => 'filter.salary.max']])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'salary';
    }
}
