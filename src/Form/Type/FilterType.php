<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Filter\FilterCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Filter Type
 */
class FilterType extends AbstractType
{
    /**
     * @var FilterCollection
     */
    private $filterCollection;

    public function __construct(FilterCollection $filterCollection)
    {
        $this->filterCollection = $filterCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->filterCollection->buildForm($builder);

        $builder
            ->setMethod('GET')
            ->add('submit', SubmitType::class, ['label' => 'filter.submit']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['csrf_protection' => false]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'filter';
    }
}
