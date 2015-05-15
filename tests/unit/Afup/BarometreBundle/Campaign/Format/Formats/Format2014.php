<?php

namespace Afup\BarometreBundle\Campaign\Format\Formats\Tests\Units;

use atoum;
use Afup\BarometreBundle\Campaign\Format\Formats\Format2014 as TestedClass;

class Format2014 extends atoum
{
    public function testAlterDataWithEmptyExperience()
    {
        $format = new TestedClass();

        $data = array_fill_keys($format->getColumns(), null);

        $data['experience'] = '';

        $alteredData = $format->alterData($data);

        $this
            ->array($alteredData)
                ->string['experience']->isEqualTo('0 à 2 ans');
    }
}
