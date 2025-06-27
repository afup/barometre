<?php

declare(strict_types=1);

namespace App\Enums;

abstract class AbstractEnums implements EnumsInterface
{
    public const AUTRE = 0;

    protected array $choices = [];

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function getIds(): array
    {
        return array_keys($this->choices);
    }

    public function getIdByLabel(?string $label): ?int
    {
        $key = array_search(trim($label ?? ''), $this->choices, true);

        return false === $key ? $this->getDefaultValue() : $key;
    }

    public function getLabelById(int $id): ?string
    {
        return $this->choices[$id] ?? null;
    }

    protected function getDefaultValue(): ?int
    {
        return self::AUTRE;
    }
}
