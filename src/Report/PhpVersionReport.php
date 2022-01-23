<?php

declare(strict_types=1);

namespace App\Report;

class PhpVersionReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.phpVersion')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'response.phpVersion is not null')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.phpVersion');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version';
    }
}
