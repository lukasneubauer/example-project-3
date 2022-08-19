<?php

declare(strict_types=1);

namespace App\Entities;

class Band
{
    /**
     * @param array<string, Disc> $discs
     */
    public function __construct(
        private string $name,
        private string $directory,
        private string $path,
        private array $discs
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
     * @return array<string, Disc>
     */
    public function getDiscs(): array
    {
        return $this->discs;
    }
}
