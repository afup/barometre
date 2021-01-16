<?php

declare(strict_types=1);

namespace Afup\Barometre\Report;

/**
 * A collection of report
 */
class ReportCollection implements \IteratorAggregate
{
    private $reports = [];

    /**
     * Add a new report
     */
    public function addReport(ReportInterface $report)
    {
        $this->reports[$report->getName()] = $report;
    }

    /**
     * sort all reports by theirs keys
     */
    public function sortReports()
    {
        uasort($this->reports, static function (ReportInterface $a, ReportInterface $b) {
            return $b->getWeight() <=> $a->getWeight();
        });
    }

    /**
     * Find a report by his name
     *
     * @param string $name
     *
     * @return ReportInterface|null
     */
    public function getReport($name)
    {
        if (!\array_key_exists($name, $this->reports)) {
            return null;
        }

        return $this->reports[$name];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->reports);
    }
}
