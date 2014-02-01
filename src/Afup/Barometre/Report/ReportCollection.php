<?php

namespace Afup\Barometre\Report;

/**
 * A collection of report
 */
class ReportCollection
{
    private $reports = array();

    /**
     * Add a new reportn
     *
     * @param ReportInterface $report
     */
    public function addReport(ReportInterface $report)
    {
        $this->reports[$report->getName()] = $report;
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
}
