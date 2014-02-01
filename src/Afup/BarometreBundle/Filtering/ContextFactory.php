<?php

namespace Afup\BarometreBundle\Filtering;

use Symfony\Component\HttpFoundation\RequestStack;

class ContextFactory
{
    public function createFromRequestStack(RequestStack $requestStack)
    {
        $request = $requestStack->getMasterRequest();

        $context = new Context();

        if (null === $request) {
            return $context;
        }

        foreach ($request->get('q', array()) as $key => $parameter) {
            if ($key == 'submit') {
                continue;
            }
            $context->setParameter($key, $parameter);
        }

        return $context;
    }
}
