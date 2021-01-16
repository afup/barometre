<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DataFixtures\ORM;

use Afup\BarometreBundle\DataTest\CustomNativeLoader;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $loader = $this->container->get(CustomNativeLoader::class);
        $objectSet = $loader->loadFiles(
            [
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/speciality.yml'),
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/certification.yml'),
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/fixtures/container_environment_usage.yml'),
                $this->getKernel()->locateResource('@AfupBarometreBundle/Resources/test/response.yml'),
            ]
        );

        $objects = $objectSet->getObjects();
        foreach ($objects as $object) {
            $manager->persist($object);
        }

        $manager->flush();
    }

    /**
     * @return KernelInterface
     */
    private function getKernel()
    {
        return $this->container->get('kernel');
    }
}
