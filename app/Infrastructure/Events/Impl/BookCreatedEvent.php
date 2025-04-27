<?php

namespace App\Infrastructure\Events\Impl;

use App\Domain\Entity\Book;
use App\Infrastructure\Events\Listener;

class BookCreatedEvent implements Listener
{
    private static self $instance;


    /**
     * @param Book $data
     */
    public function execute(mixed $data): void
    {
        echo "Book {$data->getId()} criado!\n";
    }

    public static function getInstance(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
