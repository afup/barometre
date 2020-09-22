<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

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

    /**
     * @var int
     */
    protected $minResult;

    /**
     * @var ReportInterface[]
     */
    protected $childReports = [];

    /**
     * @param int $minResult
     */
    public function __construct($minResult = 10)
    {
        $this->minResult = $minResult;
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
        return 'report.' . $this->getName() . '.label';
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        return \count($this->getData());
    }

    /**
     * report weight
     *
     * @return null
     */
    public function getWeight()
    {
        return 0;
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

    protected function addPercentResponse(array $data): array
    {
        $totalResponseNumber = $this->calculateTotalResponseNumber($data);

        if ($totalResponseNumber === 0) {
            return array_map(
                function ($response) use ($totalResponseNumber) {
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

    private function calculateTotalResponseNumber(array $data): int
    {
        return array_reduce(
            $data,
            static function ($totalResponseNumber, $response) {
                return $totalResponseNumber + $response['nbResponse'];
            },
            0
        );
    }
}
