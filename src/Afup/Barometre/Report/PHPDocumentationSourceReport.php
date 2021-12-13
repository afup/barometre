<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

class PHPDocumentationSourceReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_documentation_report';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.phpDocumentationSource')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.phpDocumentationSource')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->execute()->fetchAll();
    }
}
