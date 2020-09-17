<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Twig;

use Afup\BarometreBundle\Enums\EnumsCollection;
use Twig\TwigFilter;

class Enums extends \Twig_Extension
{
    /**
     * @var EnumsCollection
     */
    protected $enums;

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
