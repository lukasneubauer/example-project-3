<?php

declare(strict_types=1);

namespace App\EntityFactories;

use App\Entities\Text;

class TextFactory
{
    public function create(string $markdown): Text
    {
        return new Text($markdown);
    }
}
