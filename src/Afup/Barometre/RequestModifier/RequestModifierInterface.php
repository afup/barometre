<?php

namespace Afup\Barometre\RequestModifier;

use Symfony\Component\HttpFoundation\Request;

interface RequestModifierInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param Request $request
     */
    public function alterRequest(Request $request);
}
