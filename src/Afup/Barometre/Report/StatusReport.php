<?php

namespace Afup\Barometre\Report;

/*
 * Report on status
 */
class StatusReport extends AbstractReport
{

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.status as status')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.status');

        $this->data = $this->queryBuilder->execute()->fetchAll();
        $this->data = $this->addPercentResponse($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {

        return 'status';
    }
}
