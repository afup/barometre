<?php

namespace Afup\Barometre\Report;

class ContractWorkDurationReport extends AbstractReport
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'contract_work_duration_report';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.contractWorkDuration')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.contractWorkDuration')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->execute();
    }
}
