<?php

namespace App\Infrastructure\Events\Impl;

use App\Infrastructure\Events\Listener;

class BookCreatedEvent implements Listener
{

    public function execute(mixed $data): void
    {
        echo "Book $data->id criado!\n";
    }
}
