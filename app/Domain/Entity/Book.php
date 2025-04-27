<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Description;
use App\Domain\ValueObject\Title;
use App\Domain\ValueObject\UUID;

class Book
{
    public function __construct(
        // Ajusta versão e variant
        protected UUID $id,
        protected Title $title,
        protected Description $description,
        protected string $authorName,
    )
    {
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }
}
