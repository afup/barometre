<?php

declare(strict_types=1);

namespace App\Report;

class AgeReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.age as age')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->andWhere('response.age > 0')
            ->addGroupBy('response.age');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'age';
    }
}
