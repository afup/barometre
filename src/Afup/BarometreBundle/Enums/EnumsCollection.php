<?php

namespace Afup\BarometreBundle\Enums;

class EnumsCollection
{
    /**
     * @var array
     */
    private $enums = [];

    /**
     * @param iterable|EnumsInterface[] $enums
     */
    public function __construct($enums)
    {
        foreach ($enums as $enum) {
            $this->enums[$enum->getName()] = $enum;
        }
    }

    /**
     * @param $alias
     *
     * @throws \InvalidArgumentException
     *
     * @return EnumsInterface
     */
    public function getEnums($alias)
    {
        if (!isset($this->enums[$alias])) {
            throw new \InvalidArgumentException(sprintf('Enums %s inconnu', $alias));
        }

        return $this->enums[$alias];
    }
}
