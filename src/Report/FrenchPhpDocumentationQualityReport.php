<?php

declare(strict_types=1);

namespace App\Report;

class FrenchPhpDocumentationQualityReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'french_php_documentation_quality_report';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.frenchPhpDocumentationQuality')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.frenchPhpDocumentationQuality')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }
}
