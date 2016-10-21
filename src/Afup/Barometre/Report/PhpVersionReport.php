<?php

namespace Afup\Barometre\Report;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class PhpVersionReport extends AbstractReport
{
    /**
     * @var Doctrine
     */
    protected $doctrine;

    /**
     * @param Doctrine $doctrine
     * @param int $minResult
     */
    public function __construct(Doctrine $doctrine, $minResult = 10)
    {
        $this->doctrine = $doctrine;
        parent::__construct($minResult);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.phpVersion')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'response.phpVersion is not null')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.phpVersion');

        $this->data = $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_version';
    }

    public function getChildReports()
    {
        return [
            new PhpVersionReportEvolution($this->doctrine),
        ];
    }
}
