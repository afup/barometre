<?php

namespace Afup\BarometreBundle\DataTest\ORM;

use Afup\BarometreBundle\DataTest\EnumsProvider;
use Afup\BarometreBundle\Enums\EnumsCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpKernel\KernelInterface;

class FixturesLoader implements FixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $enumsCollection = $this->container->get(EnumsCollection::class);
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
                ],
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
