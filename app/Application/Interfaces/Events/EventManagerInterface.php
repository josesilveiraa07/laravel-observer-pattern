<?php

namespace App\Application\Interfaces\Events;

use Psy\Readline\Hoa\EventListener;

interface EventManagerInterface
{
    public function subscribe(string $eventType, EventListenerInterface $listener): void;

    public function unsubscribe(string $eventType, EventListenerInterface $listener): void;

    public function notify(string $eventType, mixed $data): void;
}
