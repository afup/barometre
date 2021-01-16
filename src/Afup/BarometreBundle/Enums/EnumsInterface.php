<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

interface EnumsInterface
{
    /**
     * @return array
     */
    public function getChoices();

    /**
     * @param string $label
     *
     * @return int|null
     */
    public function getIdByLabel($label);

    /**
     * @param string $id
     *
     * @return string|null
     */
    public function getLabelById($id);

    public function getAlias(): string;
}
