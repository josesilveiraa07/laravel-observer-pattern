<?php

namespace App\Application\Interfaces\Repositories;

use App\Application\DTOs\CreateBookDTO;
use App\Application\DTOs\UpdateBookDTO;
use App\Domain\Entity\Book;

interface BookRepositoryInterface
{
    public function create(CreateBookDTO $data): Book;

    /**
     * @return Book[]
     */
    public function all(): array;

    public function update(string $id, UpdateBookDTO $data): Book;

    public function getById(string $id): Book;

    public function delete(string $id): Book;
}
