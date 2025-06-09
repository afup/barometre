<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private CustomNativeLoader $loader;

    public function __construct(CustomNativeLoader $customNativeLoader)
    {
        $this->loader = $customNativeLoader;
    }

    public function load(ObjectManager $manager): void
    {
        $objectSet = $this->loader->loadFiles([
            __DIR__.'/Fixtures/campaign.yml',
            __DIR__.'/Fixtures/speciality.yml',
            __DIR__.'/Fixtures/certification.yml',
            __DIR__.'/Fixtures/container_environment_usage.yml',
            __DIR__.'/Fixtures/hosting_type.yml',
            __DIR__.'/Fixtures/job_interest.yml',
            __DIR__.'/Fixtures/response.yml',
        ]);

        $objects = $objectSet->getObjects();
        foreach ($objects as $object) {
            $manager->persist($object);
        }

        $manager->flush();
    }
}
