<?php

namespace App\Application\UseCases;

use App\Application\DTOs\UpdateBookDTO;
use App\Application\Interfaces\Repositories\BookRepositoryInterface;
use App\Domain\Entity\Book;

readonly class UpdateBookUseCase
{
    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }

    public function execute(string $id, UpdateBookDTO $data): Book
    {
        return $this->bookRepository->update($id, $data);
    }
}
