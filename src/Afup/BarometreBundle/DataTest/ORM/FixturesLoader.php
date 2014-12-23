<?php

namespace Afup\BarometreBundle\DataTest\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Afup\BarometreBundle\DataTest\EnumsProvider;
use Symfony\Component\DependencyInjection\ContainerAware;

class FixturesLoader extends ContainerAware implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $enumsCollection = $this->container->get('afup.barometre.enums_collection');
        Fixtures::load(
            array(
                __DIR__ . '/../../Resources/fixtures/speciality.yml',
                __DIR__ . '/../../Resources/fixtures/certification.yml',
                __DIR__ . '/../../Resources/test/response.yml',
            ),
            $manager,
            array(
                'providers' => array(
                    new EnumsProvider($enumsCollection),
                )
            )
        );
    }
}
