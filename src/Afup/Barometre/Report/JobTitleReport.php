<?php

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
        $this->data = $this->addPercentResponse($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'job_title';
    }
}
