<?php

namespace App\Application\UseCases;

use App\Application\DTOs\CreateBookDTO;
use App\Application\Interfaces\Repositories\BookRepositoryInterface;
use App\Domain\Entity\Book;

readonly class CreateBookUseCase
{
    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }

    public function execute(CreateBookDTO $data): Book
    {
        return $this->bookRepository->create($data);
    }
}
