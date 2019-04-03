<?php

namespace Yii\EventDispatcher\Provider;

use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Aggregate is a listener provider that allows combining
 * multiple listener providers.
 */
final class Aggregate implements ListenerProviderInterface
{
    /**
     * @var ListenerProviderInterface[]
     */
    private $providers;

    public function getListenersForEvent(object $event): iterable
    {
        foreach ($this->providers as $provider) {
            yield from $provider->getListenersForEvent($event);
        }
    }

    /**
     * Appends a provider as a source for event listeners.
     *
     * @param ListenerProviderInterface $provider
     */
    public function append(ListenerProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }
}
