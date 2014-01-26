<?php

namespace Afup\BarometreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilteringType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $filters = $options['filters'];
        $builder->setMethod('GET');
        foreach ($filters as $filter) {
            $builder->add($filter->getIdentifier(), 'choice', array(
              'choices' => $filter->getChoices(),
              'label' => $filter->getLabel(),
              'required' => false,
              'multiple' => true,
              'attr' => array('class' => 'select2')
            ));
        }

        $builder->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
          'filters' => array(),
          'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'q';
    }
}
