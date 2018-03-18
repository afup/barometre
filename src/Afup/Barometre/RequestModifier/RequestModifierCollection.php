<?php

namespace Afup\Barometre\RequestModifier;

class RequestModifierCollection
{
    /**
     * @var RequestModifierInterface[]
     */
    private $modifier = [];

    /**
     * @param RequestModifierInterface $modifier
     */
    public function addModifier(RequestModifierInterface $modifier)
    {
        if (isset($this->modifier[$modifier->getName()])) {
            throw new \LogicException('filter of same weight already added');
        }
        $this->modifier[$modifier->getName()] = $modifier;
    }

    /**
     * @param string $name
     *
     * @return RequestModifierInterface|null
     */
    public function getModifier($name)
    {
        return isset($this->modifier[$name]) ? $this->modifier[$name] : null;
    }
}
