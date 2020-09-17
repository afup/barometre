<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Campaign\Format;

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
