<?php

namespace Afup\BarometreBundle\Enums;

abstract class AbstractEnums implements EnumsInterface
{
    const AUTRE = 0;

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
    public function getIdByLabel($label)
    {
        $key = array_search(trim($label), $this->choices);

        return false === $key ? null : $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabelById($id)
    {
        return isset($this->choices[$id])? $this->choices[$id] : null;
    }
}
