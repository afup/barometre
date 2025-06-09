<?php

declare(strict_types=1);

namespace App\DataFixtures\Provider;

use App\Enums\EnumsCollection;
use Faker\Generator;
use Faker\Provider\Base;

class EnumsProvider extends Base
{
    protected EnumsCollection $collection;

    public function __construct(Generator $generator, EnumsCollection $collection)
    {
        parent::__construct($generator);

        $this->collection = $collection;
    }

    public function enums(string $alias)
    {
        $choices = $this->collection->getEnums($alias)->getChoices();

        return array_rand($choices);
    }

    public function enumIds(string $alias)
    {
        $ids = $this->collection->getEnums($alias)->getIds();

        return array_rand($ids);
    }
}
