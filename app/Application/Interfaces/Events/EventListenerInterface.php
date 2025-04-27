<?php

namespace App\Application\Interfaces\Events;

interface EventListenerInterface
{
    public function execute(mixed $data): void;
}
