<?php

namespace Afup\BarometreBundle\DataFixtures\ORM;

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
                __DIR__ . '/../../Resources/fixtures/speciality.yml',
                __DIR__ . '/../../Resources/fixtures/certification.yml',
            ),
            $manager
        );
    }
}
