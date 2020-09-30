<?php

declare(strict_types=1);

namespace Afup\Barometre\RequestModifier;

use Symfony\Component\HttpFoundation\Request;

interface RequestModifierInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return void
     */
    public function alterRequest(Request $request);
}
