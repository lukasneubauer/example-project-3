<?php

declare(strict_types=1);

namespace App\EntityFactories;

use App\Entities\Disc;
use App\Entities\Song;

class DiscFactory
{
    /**
     * @param array<string, Song> $songs
     */
    public function create(
        string $name,
        string $directory,
        string $path,
        array $songs
    ): Disc {
        return new Disc($name, $directory, $path, $songs);
    }
}
