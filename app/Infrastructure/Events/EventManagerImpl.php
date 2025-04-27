<?php

namespace App\Infrastructure\Events;

use App\Application\Interfaces\Events\EventListenerInterface;
use App\Application\Interfaces\Events\EventManagerInterface;
use RuntimeException;

class EventManagerImpl implements EventManagerInterface
{
    private array $listeners = [];

    public function subscribe(string $eventType, EventListenerInterface $listener): void
    {
        if (!isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = [];
        }

        $this->listeners[$eventType][] = $listener;
    }

    public function unsubscribe(string $eventType, EventListenerInterface $listener): void
    {
        if (isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = array_filter(
                $this->listeners[$eventType],
                fn($existingListener) => $existingListener !== $listener
            );
        }
    }

    public function notify(string $eventType, mixed $data): void
    {
        if (isset($this->listeners[$eventType])) {
            foreach ($this->listeners[$eventType] as $listener) {
                if (!$listener instanceof EventListenerInterface) {
                    throw new RuntimeException("EventListenerInterface must implement EventListenerInterface interface.");
                }

                $listener->execute($data);
            }
        }
    }
}
