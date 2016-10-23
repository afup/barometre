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
     *
     * @return void
     */
    public function alterRequest(Request $request);
}
