<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DataTest;

use Afup\BarometreBundle\Enums\EnumsCollection;
use Faker\Generator as FakerGenerator;
use Nelmio\Alice\Loader\NativeLoader;

class CustomNativeLoader extends NativeLoader
{
    /**
     * @var EnumsCollection
     */
    private $enumsCollection;

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
