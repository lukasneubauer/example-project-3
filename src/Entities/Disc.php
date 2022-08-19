<?php

declare(strict_types=1);

namespace App\Entities;

class Disc
{
    /**
     * @param array<string, Song> $songs
     */
    public function __construct(
        private string $name,
        private string $directory,
        private string $path,
        private array $songs
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array<string, Song>
     */
    public function getSongs(): array
    {
        return $this->songs;
    }
}
