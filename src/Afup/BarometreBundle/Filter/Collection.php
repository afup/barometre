<?php

namespace Afup\BarometreBundle\Filter;

class Collection
{
    public static function getAll()
    {
        $filterFactory = new \Afup\BarometreBundle\Filter\Factory();
        $all = array();
        foreach (static::getAllCodes() as $code) {
            $all[] = $filterFactory->create($code);
        }
        return $all;
    }

    public static function getAllCodes()
    {
        return array(
            'company_size',
            'company_type',
        );
    }
}
