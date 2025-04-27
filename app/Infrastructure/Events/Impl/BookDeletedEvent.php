<?php

namespace App\Infrastructure\Events\Impl;

use App\Infrastructure\Events\Listener;

class BookDeletedEvent implements Listener
{

    public function execute(mixed $data): void
    {
        echo "Book $data->id deletado!\n";
    }
}
