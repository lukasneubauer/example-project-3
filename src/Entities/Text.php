<?php

declare(strict_types=1);

namespace App\Entities;

class Text
{
    public function __construct(
        private string $markdown
    ) {
    }

    public function getMarkdown(): string
    {
        return $this->markdown;
    }
}
