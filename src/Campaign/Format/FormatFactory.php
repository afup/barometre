<?php

declare(strict_types=1);

namespace App\Campaign\Format;

class FormatFactory
{
    /**
     * @param string $code
     *
     * @return FormatInterface
     */
    public function createFromCode($code)
    {
        $class = '\App\Campaign\Format\Formats\Format' . $code;
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Code %s invalid', $code));
        }

        return new $class();
    }
}
