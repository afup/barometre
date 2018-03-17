<?php

namespace Afup\BarometreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Symfony\Component\DependencyInjection\ContainerAware;
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
        Fixtures::load(
            [
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/speciality.yml'),
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/certification.yml'),
            ],
            $manager
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
