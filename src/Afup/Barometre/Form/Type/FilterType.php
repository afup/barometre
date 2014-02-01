<?php

namespace Afup\Barometre\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilterType extends AbstractType
{
    private $filterCollection;

    public function __construct(FilterCollection $filterCollection)
    {
        $this->filterCollection = $filterCollection;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->filterCollection->buildForm($builder);

        $builder
            ->setMethod('GET')
            ->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['csrf_protection' => false]);
    }

    public function getName()
    {
        return 'filter';
    }
}
