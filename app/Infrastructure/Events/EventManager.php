<?php

namespace App\Infrastructure\Events;

class EventManager
{
    private array $listeners = [];

    public function subscribe(string $eventType, string $listenerClass): void
    {
        if (!isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = [];
        }

        $this->listeners[$eventType][] = $listenerClass;
    }

    public function unsubscribe(string $eventType, string $listenerClass): void
    {
        if (isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = array_filter(
                $this->listeners[$eventType],
                fn($listener) => $listener !== $listenerClass
            );
        }
    }

    public function notify(string $eventType, mixed $data): void
    {
        if (isset($this->listeners[$eventType])) {
            foreach ($this->listeners[$eventType] as $listenerClass) {
                $listener = new $listenerClass();

                if (method_exists($listener, 'execute')) {
                    $listener->execute($data);
                }
            }
        }
    }
}
