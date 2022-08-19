<?php

declare(strict_types=1);

namespace App\Searching;

class SearchIndexFactory
{
    public function create(): SearchIndex
    {
        return new SearchIndex();
    }
}
