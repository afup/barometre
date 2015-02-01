<?php

namespace Afup\Barometre\Filter;

use Afup\BarometreBundle\Entity\Certification;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;

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
    public function buildQuery(QueryBuilder $queryBuilder, array $values = [])
    {
        if (!array_key_exists($this->getName(), $values) || 0 === count($values[$this->getName()])) {
            return;
        }

        $certifications = $values[$this->getName()]->toArray();
        $certifications = array_map(function (Certification $item) {
            return $item->getId();
        }, $certifications);

        $queryBuilder
            ->leftJoin(
                'response',
                'response_certification',
                'response_certification',
                'response.id = response_certification.response_id'
            )
            ->andWhere($queryBuilder->expr()->in('response_certification.certification_id', $certifications));
    }

    /**
     * {@inheritdoc}
     */
    public function convertValuesToLabels($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'certifications';
    }

    /**
     * Filter weight
     *
     * @return int
     */
    public function getWeight()
    {
        return 8;
    }
}
