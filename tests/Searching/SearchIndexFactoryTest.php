<?php

declare(strict_types=1);

namespace Tests\App\Searching;

use App\Searching\SearchIndex;
use App\Searching\SearchIndexFactory;
use PHPUnit\Framework\TestCase;

final class SearchIndexFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $searchIndexFactory = new SearchIndexFactory();
        $searchIndex = $searchIndexFactory->create();
        self::assertInstanceOf(SearchIndex::class, $searchIndex);
    }
}
