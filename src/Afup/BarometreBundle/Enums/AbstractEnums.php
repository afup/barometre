<?php

namespace Afup\BarometreBundle\Enums;

abstract class AbstractEnums implements EnumsInterface
{
    protected $choices = array();

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdByLibelle($libelle)
    {
        $key = array_search(trim($libelle), $this->choices);

        return false === $key ? null : $key;
    }
}
