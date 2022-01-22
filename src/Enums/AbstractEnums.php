<?php

declare(strict_types=1);

namespace App\Enums;

abstract class AbstractEnums implements EnumsInterface
{
    const AUTRE = 0;

    protected $choices = [];

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

        return false === $key ? $this->getDefaultValue() : $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabelById($id)
    {
        return isset($this->choices[$id]) ? $this->choices[$id] : null;
    }

    /**
     * @return int
     */
    protected function getDefaultValue()
    {
        return self::AUTRE;
    }
}
