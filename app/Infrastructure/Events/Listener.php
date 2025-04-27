<?php

namespace App\Infrastructure\Events;

interface Listener
{
    public function execute(mixed $data): void;
}
