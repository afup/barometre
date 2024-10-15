<?php

declare(strict_types=1);

namespace App\Enums;

class EnumsCollection
{
    private array $enums = [];

    public function __construct(iterable $enums = [])
    {
        foreach ($enums as $enum) {
            $this->enums[$enum::class] = $enum;
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function getEnums($alias): EnumsInterface
    {
        if (!isset($this->enums[$alias])) {
            throw new \InvalidArgumentException(\sprintf('Enums %s inconnu', $alias));
        }

        return $this->enums[$alias];
    }
}
