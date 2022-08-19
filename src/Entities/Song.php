<?php

declare(strict_types=1);

namespace App\Entities;

class Song
{
    public function __construct(
        private string $name,
        private string $file,
        private string $path,
        private Text $text
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getText(): Text
    {
        return $this->text;
    }
}
