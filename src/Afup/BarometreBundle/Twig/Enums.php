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
        return array(
            'enum_label' => new \Twig_Filter_Method($this, 'enumLabel'),
        );
    }

    /**
     * @param int $enumId
     * @param string $enumLabel
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

    /**
     * @return string
     */
    public function getName()
    {
        return 'afup_barometre_twig_enums';
    }
}
