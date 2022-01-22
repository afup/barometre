<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Enums\EnumsCollection;
use Faker\Generator as FakerGenerator;
use Nelmio\Alice\Loader\NativeLoader;

class CustomNativeLoader extends NativeLoader
{
    private EnumsCollection $enumsCollection;

    public function __construct(EnumsCollection $enumsCollection)
    {
        $this->enumsCollection = $enumsCollection;

        parent::__construct();
    }

    protected function createFakerGenerator(): FakerGenerator
    {
        $generator = parent::createFakerGenerator();
        $generator->addProvider(new EnumsProvider($generator, $this->enumsCollection));

        return $generator;
    }
}
