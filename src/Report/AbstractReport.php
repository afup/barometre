<?php

declare(strict_types=1);

namespace App\Report;

use Doctrine\DBAL\Query\QueryBuilder;

abstract class AbstractReport implements ReportInterface
{
    /**
     * @var array|null
     */
    protected $data;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    public function __construct(
        protected int $minResult = 10,
        protected array $childReports = [],
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'report.'.$this->getName().'.label';
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return null !== $this->data && \count($this->getData());
    }

    /**
     * report weight.
     *
     * @return null
     */
    public function getWeight()
    {
        return 0;
    }

    /**
     * comparaison function for reports.
     *
     * @param AbstractReport $report1
     * @param AbstractReport $report2
     *
     * @return int
     */
    public static function cmpReport($report1, $report2)
    {
        if ($report1->getWeight() === $report2->getWeight()) {
            return 0;
        }

        return ($report1->getWeight() < $report2->getWeight()) ? 1 : -1;
    }

    /**
     * @return array
     */
    public function getChildReports()
    {
        return $this->childReports;
    }

    /**
     * @return array
     */
    public function setChildReports(array $childReports)
    {
        return $this->childReports = $childReports;
    }

    /**
     * @return array
     */
    protected function addPercentResponse(array $data)
    {
        $totalResponseNumber = $this->calculateTotalResponseNumber($data);

        if (0 === $totalResponseNumber) {
            return array_map(
                function ($response) {
                    $response['percentResponse'] = 0;

                    return $response;
                },
                $data
            );
        }

        return array_map(
            function ($response) use ($totalResponseNumber) {
                $response['percentResponse'] = $response['nbResponse'] * 100 / $totalResponseNumber;

                return $response;
            },
            $data
        );
    }

    /**
     * @return int mixed
     */
    private function calculateTotalResponseNumber(array $data)
    {
        return array_reduce(
            $data,
            function ($totalResponseNumber, $response) {
                return $totalResponseNumber += $response['nbResponse'];
            },
            0
        );
    }
}
