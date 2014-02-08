<?php

namespace Afup\Barometre\Filter;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\QueryBuilder;

class CertificationFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), 'entity', [
            'label'    => 'filter.certification',
            'class'    => 'Afup\BarometreBundle\Entity\Certification',
            'attr'     => ['class' => 'select2'],
            'multiple' => true,
            'required' => false,
            'query_builder' => function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('certification')
                    ->orderBy('certification.name', 'ASC');
            }
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(QueryBuilder $queryBuilder, array $values = array())
    {
        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $certifications = $values[$this->getName()]->toArray();
        $certifications = array_map(function ($item) {
            return $item->getId();
        }, $certifications);

        $queryBuilder
            ->andWhere($queryBuilder->expr()->in('certification.id', $certifications));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'certifications';
    }
}
