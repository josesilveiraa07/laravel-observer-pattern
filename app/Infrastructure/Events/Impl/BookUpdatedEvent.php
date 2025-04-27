<?php

namespace App\Infrastructure\Events\Impl;

use App\Domain\Entity\Book;
use App\Infrastructure\Events\Listener;

class BookUpdatedEvent implements Listener
{
    /**
     * @param Book $data
     */
    public function execute(mixed $data): void
    {
        echo "Book {$data->getId()} atualizado!\n";
    }
}
