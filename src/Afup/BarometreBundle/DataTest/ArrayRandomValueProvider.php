<?php

namespace Afup\BarometreBundle\DataTest;

class ArrayRandomValueProvider
{
    /**
     * @param int $minNumber
     * @param int $maxNumber
     * @param int $minValue
     * @param int $maxValue
     *
     * @return array
     */
    public function arrayRandomValue($minNumber, $maxNumber, $minValue, $maxValue)
    {
        $nbValue = mt_rand($minNumber, $maxNumber);

        if (0 === $nbValue) {
            return array();
        }

        $results = [];

        for ($i = 0; $i < $nbValue; $i++) {
            $results[] = mt_rand($minValue, $maxValue);
        }

        return array_unique($results);
    }
}
