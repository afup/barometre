<?php

namespace Afup\BarometreBundle\Enums;

class EnumsCollection
{
    /**
     * @var array
     */
    private $enums = [];

    /**
     * @param EnumsInterface $enums
     * @param string         $alias
     */
    public function addEnums(EnumsInterface $enums, $alias)
    {
        $this->enums[$alias] = $enums;
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
