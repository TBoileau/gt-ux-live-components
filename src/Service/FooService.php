<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\UX\TwigComponent\EventListener\PreRenderEvent;

class FooService implements EventSubscriberInterface
{
    public function onPreRender(PreRenderEvent $event): void
    {

        // manipulate the variables:
        $variables = $event->getVariables();
        $variables['custom'] = 'value';

        $event->setVariables($variables); // {{ custom }} will be available in your template
    }

    public static function getSubscribedEvents(): array
    {
        return [PreRenderEvent::class => 'onPreRender'];
    }

}
