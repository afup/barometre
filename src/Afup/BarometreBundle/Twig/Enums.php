<?php

namespace Afup\BarometreBundle\Twig;

use Afup\BarometreBundle\Enums\EnumsCollection;

class Enums extends \Twig_Extension
{
    /**
     * @var EnumsCollection
     */
    protected $enums;

    /**
     * @param EnumsCollection $enums
     */
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
            new \Twig_SimpleFilter('enum_label', [$this, 'enumLabel']),
        ];
    }

    /**
     * @param int $enumId
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
