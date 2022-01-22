<?php

declare(strict_types=1);

namespace App\Twig;

use App\Enums\EnumsCollection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Enums extends AbstractExtension
{
    protected EnumsCollection $enums;

    public function __construct(EnumsCollection $enums)
    {
        $this->enums = $enums;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('enum_label', [$this, 'enumLabel']),
        ];
    }

    /**
     * @param int    $enumId
     * @param string $enumName
     *
     * @return string
     */
    public function enumLabel($enumId, $enumName)
    {
        $choices = $this->enums->getEnums($enumName)->getChoices();
        if (!isset($choices[$enumId])) {
            return $enumId;
        }

        return $choices[$enumId];
    }
}
