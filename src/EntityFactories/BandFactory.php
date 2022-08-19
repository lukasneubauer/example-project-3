<?php

declare(strict_types=1);

namespace App\EntityFactories;

use App\Entities\Band;
use App\Entities\Disc;

class BandFactory
{
    /**
     * @param array<string, Disc> $discs
     */
    public function create(
        string $name,
        string $directory,
        string $path,
        array $discs
    ): Band {
        return new Band($name, $directory, $path, $discs);
    }
}
