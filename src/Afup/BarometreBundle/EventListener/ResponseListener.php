<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->setSharedMaxAge(31536000);
    }
}
