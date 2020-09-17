<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DataTest;

use Afup\BarometreBundle\Enums\EnumsCollection;
use Faker\Provider\Base;

class EnumsProvider extends Base
{
    /**
     * @var EnumsCollection
     */
    protected $collection;

    public function __construct(EnumsCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param string $alias
     */
    public function enums($alias)
    {
        $choices = $this->collection->getEnums($alias)->getChoices();

        return array_rand($choices);
    }
}
