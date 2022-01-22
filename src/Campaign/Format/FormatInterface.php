<?php

declare(strict_types=1);

namespace App\Campaign\Format;

interface FormatInterface
{
    /**
     * @return array
     */
    public function getColumns();

    /**
     * @return array
     */
    public function alterData(array $data);
}
