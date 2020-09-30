<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Campaign\Format;

class FormatFactory
{
    /**
     * @param string $code
     *
     * @return FormatInterface
     */
    public function createFromCode($code)
    {
        $class = '\Afup\BarometreBundle\Campaign\Format\Formats\Format' . $code;
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Code %s invalid', $code));
        }

        return new $class();
    }
}
