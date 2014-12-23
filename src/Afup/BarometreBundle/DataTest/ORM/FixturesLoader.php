<?php

namespace Afup\BarometreBundle\DataTest\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Afup\BarometreBundle\DataTest\EnumsProvider;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\KernelInterface;

class FixturesLoader extends ContainerAware implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $enumsCollection = $this->container->get('afup.barometre.enums_collection');
        Fixtures::load(
            [
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/speciality.yml'),
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/certification.yml'),
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/test/response.yml'),
            ],
            $manager,
            [
                'providers' => [
                    new EnumsProvider($enumsCollection),
                ]
            ]
        );
    }

    /**
     * @return KernelInterface
     */
    private function getKernel()
    {
        return $this->container->get('kernel');
    }
}
