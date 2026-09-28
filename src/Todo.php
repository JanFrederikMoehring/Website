<?php

readonly class Todo
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public ?string $date,
        public bool $status,
    ) {
    }
}
