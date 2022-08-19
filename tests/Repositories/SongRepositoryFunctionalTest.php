<?php

declare(strict_types=1);

namespace Tests\App\Repositories;

use App\Entities\Song;
use App\Repositories\SongRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SongRepositoryFunctionalTest extends WebTestCase
{
    public function testGetSongs(): void
    {
        $dic = static::getContainer();

        /** @var SongRepository $songRepository */
        $songRepository = $dic->get(SongRepository::class);

        $songs = $songRepository->getSongs('band-1', 'disc-1');

        $song01 = $songs['song-01'];
        $song02 = $songs['song-02'];
        $song03 = $songs['song-03'];

        self::assertSame('Song 01', $song01->getName());
        self::assertSame('01_Song_01.md', $song01->getFile());
        self::assertSame('song-01', $song01->getPath());

        self::assertSame('Song 02', $song02->getName());
        self::assertSame('02_Song_02.md', $song02->getFile());
        self::assertSame('song-02', $song02->getPath());

        self::assertSame('Song 03', $song03->getName());
        self::assertSame('03_Song_03.md', $song03->getFile());
        self::assertSame('song-03', $song03->getPath());

        $text01 = $song01->getText();
        $text02 = $song02->getText();
        $text03 = $song03->getText();

        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text01->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text02->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text03->getMarkdown());
    }

    public function testGetSong(): void
    {
        $dic = static::getContainer();

        /** @var SongRepository $songRepository */
        $songRepository = $dic->get(SongRepository::class);

        $song = $songRepository->getSong('band-1', 'disc-1', 'song-01');

        if ($song instanceof Song === false) {
            self::fail(
                \sprintf(
                    'Failed to assert that $band is %s. It is %s instead.',
                    Song::class,
                    \gettype($song)
                )
            );
        }

        $text = $song->getText();

        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text->getMarkdown());
    }

    public function testGetSongReturnsNull(): void
    {
        $dic = static::getContainer();

        /** @var SongRepository $songRepository */
        $songRepository = $dic->get(SongRepository::class);

        $song = $songRepository->getSong('band-1', 'disc-1', 'song-xy');

        self::assertNull($song);
    }
}
