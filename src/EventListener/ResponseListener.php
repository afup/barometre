<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseListener
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        $event->getResponse()->setSharedMaxAge(31536000);
    }
}
