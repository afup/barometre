<?php

declare(strict_types=1);

namespace App\Filtering;

class Context
{
    /**
     * @var array
     */
    protected $parameters = [];

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}
