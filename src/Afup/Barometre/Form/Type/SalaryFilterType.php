<?php

namespace Afup\Barometre\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('min', 'number', ['required' => false])
            ->add('max', 'number', ['required' => false]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'salary';
    }
}
