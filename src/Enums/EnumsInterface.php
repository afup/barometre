<?php

declare(strict_types=1);

namespace App\Enums;

interface EnumsInterface
{
    public function getChoices(): array;

    public function getIdByLabel(?string $label): ?int;

    public function getLabelById(string $id): ?string;
}
