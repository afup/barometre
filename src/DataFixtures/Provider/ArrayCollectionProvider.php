<?php

namespace App\DataFixtures\Provider;

use Doctrine\Common\Collections\ArrayCollection;
use Faker\Provider\Base;

final class ArrayCollectionProvider extends Base
{
    public function randomArrayCollection(array $entities, int $min, int $max)
    {
        $nbItems = self::numberBetween($min, $max);

        return new ArrayCollection(self::randomElements($entities, $nbItems, false));
    }
}
