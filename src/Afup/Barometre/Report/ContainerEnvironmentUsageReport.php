<?php

namespace Afup\Barometre\Report;

class ContainerEnvironmentUsageReport extends AbstractReport
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'container_environment_report';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('count(distinct response.id) as nbResponse')
            ->addSelect('container_environment_usage.name as containerEnvironmentUsage')
            ->leftJoin(
                'response',
                'response_containerenvironmentusage',
                'response_containerenvironmentusage',
                'response.id = response_containerenvironmentusage.response_id'
            )
            ->leftJoin(
                'response_containerenvironmentusage',
                'container_environment_usage',
                'container_environment_usage',
                'response_containerenvironmentusage.containerenvironmentusage_id = container_environment_usage.id'
            )
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('containerEnvironmentUsage')
            ->orderBy('nbResponse', 'desc')
        ;

        $this->data = $this->queryBuilder->execute();
    }
}
