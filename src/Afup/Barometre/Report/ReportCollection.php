<?php

namespace Afup\Barometre\Report;

/**
 * A collection of report
 */
class ReportCollection implements \IteratorAggregate
{
    private $reports = array();

    /**
     * Add a new report
     *
     * @param ReportInterface $report
     */
    public function addReport(ReportInterface $report)
    {
        $keyName = $report->getName();
        if (null !== $report->getWeight()) {
            $keyName = sprintf('%04d'.$keyName, $report->getWeight());
        }
        $this->reports[$keyName] = $report;
    }

    /**
     * sort all reports by theirs keys
     *
     */
    public function sortReports()
    {
        ksort($this->reports);
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
