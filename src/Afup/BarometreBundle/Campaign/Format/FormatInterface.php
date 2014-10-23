<?php

namespace Afup\BarometreBundle\Campaign\Format;

interface FormatInterface
{
    /**
     * @return array
     */
    public function getColumns();

    /**
     * @param array $data
     *
     * @return array
     */
    public function alterData(array $data);
}
