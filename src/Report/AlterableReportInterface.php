<?php

declare(strict_types=1);

namespace App\Report;

use Symfony\Component\HttpFoundation\Request;

interface AlterableReportInterface
{
    public function alterRequest(Request $request);
}
