<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\CreateBookDTO;
use App\Application\DTOs\UpdateBookDTO;
use App\Application\Interfaces\Events\EventManagerInterface;
use App\Application\Interfaces\Repositories\BookRepositoryInterface;
use App\Domain\Entity\Book;
use App\Domain\ValueObject\Description;
use App\Domain\ValueObject\Title;
use App\Domain\ValueObject\UUID;
use App\Infrastructure\Events\Impl\BookCreatedEvent;
use App\Infrastructure\Events\Impl\BookDeletedEvent;
use App\Infrastructure\Events\Impl\BookUpdatedEvent;
use App\Infrastructure\Persistence\BookModel;
use Random\RandomException;

readonly class BookRepository implements BookRepositoryInterface
{
    public function __construct(
        private EventManagerInterface $eventManager,
        private BookCreatedEvent $bookCreatedEvent,
        private BookUpdatedEvent $bookUpdatedEvent,
        private BookDeletedEvent $bookDeletedEvent
    ) {
        $this->eventManager->subscribe('book.created', $this->bookCreatedEvent);
        $this->eventManager->subscribe('book.updated', $this->bookUpdatedEvent);
        $this->eventManager->subscribe('book.deleted', $this->bookDeletedEvent);
    }

    /**
     * @throws RandomException
     */
    public function create(CreateBookDTO $data): Book
    {
        $id = UUID::random();

        $book = new Book($id, new Title($data->title), new Description($data->description), $data->authorName);

        $bookModel = new BookModel();

        $bookModel->id = $book->getId()->getValue();
        $bookModel->title = $book->getTitle()->getValue();
        $bookModel->description = $book->getDescription()->getValue();
        $bookModel->author_name = $book->getAuthorName();

        $bookModel->save();

        $this->eventManager->notify('book.created', $book);

        return $book;
    }


    /**
     * @return Book[] array of Book objects
     */
    public function all(): array
    {
        $books = BookModel::all();

        return $books->map(function ($book) {
            return new Book(
                new UUID($book->id),
                new Title($book->title),
                new Description($book->description),
                $book->author_name
            );
        })->toArray();
    }

    public function getById(string $id): Book
    {
        $book = BookModel::findOrFail($id);

        return new Book(
            new UUID($book->id),
            new Title($book->title),
            new Description($book->description),
            $book->author_name
        );
    }

    public function update(string $id, UpdateBookDTO $data): Book
    {
        $originalBook = BookModel::findOrFail($id);

        $book = new Book(
            new UUID($originalBook->id),
            new Title($data->title),
            new Description($data->description),
            $data->authorName
        );

        $originalBook->title = $book->getTitle()->getValue();
        $originalBook->description = $book->getDescription()->getValue();
        $originalBook->author_name = $book->getAuthorName();

        $originalBook->save();

        $this->eventManager->notify('book.updated', $book);

        return $book;
    }

    public function delete(string $id): Book
    {
        $originalBook = BookModel::findOrFail($id);


        $book = new Book(
            new UUID($originalBook->id),
            new Title($originalBook->title),
            new Description($originalBook->description),
            $originalBook->author_name
        );

        $originalBook->delete();

        $this->eventManager->notify('book.deleted', $book);

        return $book;
    }
}
