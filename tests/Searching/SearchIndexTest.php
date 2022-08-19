<?php

declare(strict_types=1);

namespace Tests\App\Searching;

use App\Searching\SearchIndex;
use PHPUnit\Framework\TestCase;

final class SearchIndexTest extends TestCase
{
    public function testAddItem(): void
    {
        $searchIndex = new SearchIndex();

        self::assertSame(
            [],
            $searchIndex->getData()
        );

        self::assertSame(
            '{}',
            $searchIndex->getJson()
        );

        $searchIndex->addItem('word-1', 'band-1', 'disc-1', 'song-1', '/path/to/song-1');
        $searchIndex->addItem('word-1', 'band-2', 'disc-1', 'song-1', '/path/to/song-1');
        $searchIndex->addItem('word-2', 'band-1', 'disc-1', 'song-1', '/path/to/song-1');
        $searchIndex->addItem('word-2', 'band-2', 'disc-1', 'song-1', '/path/to/song-1');

        $data = [
            'word-1' => [
                'band-1' => [
                    'disc-1' => [
                        'song-1' => [
                            '/path/to/song-1',
                        ],
                    ],
                ],
                'band-2' => [
                    'disc-1' => [
                        'song-1' => [
                            '/path/to/song-1',
                        ],
                    ],
                ],
            ],
            'word-2' => [
                'band-1' => [
                    'disc-1' => [
                        'song-1' => [
                            '/path/to/song-1',
                        ],
                    ],
                ],
                'band-2' => [
                    'disc-1' => [
                        'song-1' => [
                            '/path/to/song-1',
                        ],
                    ],
                ],
            ],
        ];

        self::assertSame($data, $searchIndex->getData());

        $json = \json_encode($data);

        self::assertSame($json, $searchIndex->getJson());
    }
}
