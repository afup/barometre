<?php

namespace Afup\Barometre\Report;

use Symfony\Component\HttpFoundation\Request;

interface AlterableReportInterface
{
    /**
     * @param Request $request
     */
    public function alterRequest(Request $request);
}
