<?php

declare(strict_types=1);

namespace App\Database;

use Symfony\Component\Finder\Finder;

class Engine
{
    public function create(): Finder
    {
        return new Finder();
    }
}
