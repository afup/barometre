<?php

namespace Afup\Barometre\Report;

class OtherLanguageReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.otherLanguage')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.otherLanguage')
            ->orderBy('nbResponse', 'desc');

        $this->data = $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'other_language';
    }

    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return -20;
    }
}
