<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

class JobTitleReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.jobTitle as jobTitle')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.jobTitle');

        $this->data = $this->queryBuilder->execute()->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'job_title';
    }
}
