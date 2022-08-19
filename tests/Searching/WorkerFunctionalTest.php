<?php

declare(strict_types=1);

namespace Tests\App\Searching;

use App\Searching\Worker;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WorkerFunctionalTest extends WebTestCase
{
    public function testCreateIndex(): void
    {
        $dic = static::getContainer();

        /** @var Worker $worker */
        $worker = $dic->get(Worker::class);

        $json = $worker->createIndex();
        $data = (array) \json_decode($json, true);

        self::assertIsArray($data);
        self::assertArrayHasKey('lorem', $data);

        $item = [
            'Band 1' => [
                'Disc 1' => [
                    'Song 01' => [
                        '/band-1/disc-1/song-01',
                    ],
                    'Song 02' => [
                        '/band-1/disc-1/song-02',
                    ],
                    'Song 03' => [
                        '/band-1/disc-1/song-03',
                    ],
                ],
                'Disc 2' => [
                    'Song 04' => [
                        '/band-1/disc-2/song-04',
                    ],
                    'Song 05' => [
                        '/band-1/disc-2/song-05',
                    ],
                    'Song 06' => [
                        '/band-1/disc-2/song-06',
                    ],
                ],
            ],
            'Band 2' => [
                'Disc 3' => [
                    'Song 07' => [
                        '/band-2/disc-3/song-07',
                    ],
                    'Song 08' => [
                        '/band-2/disc-3/song-08',
                    ],
                    'Song 09' => [
                        '/band-2/disc-3/song-09',
                    ],
                ],
                'Disc 4' => [
                    'Song 10' => [
                        '/band-2/disc-4/song-10',
                    ],
                    'Song 11' => [
                        '/band-2/disc-4/song-11',
                    ],
                    'Song 12' => [
                        '/band-2/disc-4/song-12',
                    ],
                ],
            ],
        ];

        self::assertSame($item, $data['lorem']);
    }
}
