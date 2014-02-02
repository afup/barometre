<?php

namespace Afup\Barometre\Filter;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;

class CertificationFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add($this->getName(), 'entity', [
            'label'    => "Certification",
            'class'    => 'Afup\BarometreBundle\Entity\Certification',
            'attr'     => ['class' => 'select2'],
            'multiple' => true,
            'required' => false
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
            ->leftJoin('response', 'response_certification', 'rc', 'response.id = rc.response_id')
            ->andWhere('rc.certification_id IN(:certifications)')
            ->setParameter('certifications', $certifications, Connection::PARAM_INT_ARRAY);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'certifications';
    }
}
