<?php

namespace App\Application\UseCases;

use App\Application\Interfaces\Repositories\BookRepositoryInterface;
use App\Domain\Entity\Book;

readonly class DeleteBookUseCase
{
    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }

    public function execute(string $id): Book
    {
        return $this->bookRepository->delete($id);
    }
}
