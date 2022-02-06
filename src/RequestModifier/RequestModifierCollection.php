<?php

declare(strict_types=1);

namespace App\RequestModifier;

class RequestModifierCollection
{
    /**
     * @var RequestModifierInterface[]
     */
    private $modifier = [];

    public function __construct(iterable $modifiers = [])
    {
        foreach ($modifiers as $modifier) {
            if (isset($this->modifier[$modifier->getName()])) {
                throw new \LogicException('filter of same weight already added');
            }

            $this->modifier[$modifier->getName()] = $modifier;
        }
    }

    /**
     * @param string $name
     *
     * @return RequestModifierInterface|null
     */
    public function getModifier($name)
    {
        return $this->modifier[$name] ?? null;
    }
}
