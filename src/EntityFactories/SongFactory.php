<?php

declare(strict_types=1);

namespace App\EntityFactories;

use App\Entities\Song;
use App\Entities\Text;

class SongFactory
{
    public function create(
        string $name,
        string $file,
        string $path,
        Text $text
    ): Song {
        return new Song($name, $file, $path, $text);
    }
}
