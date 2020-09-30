<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

class HostingTypeReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hosting_type_report';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('count(distinct response.id) as nbResponse')
            ->addSelect('hosting_type.name as hostingType')
            ->join(
                'response',
                'response_hostingtype',
                'response_hostingtype',
                'response.id = response_hostingtype.response_id'
            )
            ->join(
                'response_hostingtype',
                'hosting_type',
                'hosting_type',
                'response_hostingtype.hostingtype_id = hosting_type.id'
            )
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('hostingType')
            ->orderBy('nbResponse', 'desc')
        ;

        $this->data = $this->queryBuilder->execute();
    }
}
