<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\DataTest;

use Afup\BarometreBundle\Enums\EnumsCollection;
use Faker\Generator as FakerGenerator;
use Nelmio\Alice\Loader\NativeLoader;

class CustomNativeLoader extends NativeLoader
{
    /**
     * @var EnumsProvider
     */
    private $provider;

    /**
     * CustomNativeLoader constructor.
     * @param EnumsProvider $provider
     */
    public function __construct(EnumsProvider $provider)
    {
        $this->provider = $provider;
        parent::__construct();
    }

    protected function createFakerGenerator(): FakerGenerator
    {
        $generator = parent::createFakerGenerator();
        $generator->addProvider($this->provider);
        $generator->seed($this->getSeed());

        return $generator;
    }
}