<?php

namespace Afup\Barometre\Report;

/**
 * A collection of report
 */
class ReportCollection implements \IteratorAggregate
{
    private $reports = [];

    /**
     * @param iterable|ReportInterface[] $reports
     */
    public function __construct($reports)
    {
        foreach ($reports as $report) {
            $this->reports[$report->getName()] = $report;
        }

        uasort($this->reports, ['Afup\Barometre\Report\AbstractReport', 'cmpReport']);
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
        if (!array_key_exists($name, $this->reports)) {
            return null;
        }

        return $this->reports[$name];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->reports);
    }
}
