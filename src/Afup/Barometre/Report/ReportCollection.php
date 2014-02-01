<?php

namespace Afup\Barometre\Report;

class ReportCollection
{
    private $reports = array();

    public function addReport(ReportInterface $report)
    {
        $this->reports[$report->getName()];
    }

    public function get($name)
    {
        if (!array_key_exists($name, $this->reports)) {
            return null;
        }

        return $this->reports[$name];
    }
}
