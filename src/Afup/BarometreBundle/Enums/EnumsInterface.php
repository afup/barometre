<?php

namespace Afup\BarometreBundle\Enums;

interface EnumsInterface
{
    /**
     * @return array
     */
    public function getChoices();

    /**
     * @param string $libelle
     *
     * @return int|null
     */
    public function getIdByLibelle($libelle);
}
