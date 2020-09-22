<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class EnumsCollection
{
    /**
     * @var array
     */
    private $enums = [];

    public function addEnums(EnumsInterface $enums)
    {
        $this->enums[$enums->getAlias()] = $enums;
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
