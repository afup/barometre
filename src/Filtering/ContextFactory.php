<?php

declare(strict_types=1);

namespace App\Filtering;

use Symfony\Component\HttpFoundation\RequestStack;

class ContextFactory
{
    public function createFromRequestStack(RequestStack $requestStack)
    {
        $request = $requestStack->getMainRequest();

        $context = new Context();

        if (null === $request) {
            return $context;
        }

        foreach ($request->get('filter', []) as $key => $parameter) {
            if ('submit' === $key) {
                continue;
            }
            $context->setParameter($key, $parameter);
        }

        return $context;
    }
}
