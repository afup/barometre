<?php

namespace Afup\BarometreBundle\DataTest\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class FixturesLoader implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            array(
                __DIR__ . '/../../Resources/test/response.yml',
            ),
            $manager
        );
    }
}
