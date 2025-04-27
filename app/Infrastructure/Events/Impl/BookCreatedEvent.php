<?php

namespace App\Infrastructure\Events\Impl;

use App\Domain\Entity\Book;
use App\Application\Interfaces\Events\EventListenerInterface;

class BookCreatedEvent implements EventListenerInterface
{
    /**
     * @param Book $data
     */
    public function execute(mixed $data): void
    {
        echo "Book {$data->getId()} criado!\n";
    }
}
