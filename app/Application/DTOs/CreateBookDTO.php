<?php

namespace App\Application\DTOs;

class CreateBookDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $authorName,
    )
    {
    }
}
