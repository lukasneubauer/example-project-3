<?php

declare(strict_types=1);

namespace Tests\App\Repositories;

use App\Entities\Disc;
use App\Repositories\DiscRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DiscRepositoryFunctionalTest extends WebTestCase
{
    public function testGetDiscs(): void
    {
        $dic = static::getContainer();

        /** @var DiscRepository $discRepository */
        $discRepository = $dic->get(DiscRepository::class);

        $discs = $discRepository->getDiscs('band-1');

        $disc1 = $discs['disc-1'];
        $disc2 = $discs['disc-2'];

        self::assertSame('Disc 1', $disc1->getName());
        self::assertSame('2001_Disc_1', $disc1->getDirectory());
        self::assertSame('disc-1', $disc1->getPath());

        self::assertSame('Disc 2', $disc2->getName());
        self::assertSame('2002_Disc_2', $disc2->getDirectory());
        self::assertSame('disc-2', $disc2->getPath());

        $songs = $disc1->getSongs();

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

        $songs = $disc2->getSongs();

        $song04 = $songs['song-04'];
        $song05 = $songs['song-05'];
        $song06 = $songs['song-06'];

        self::assertSame('Song 04', $song04->getName());
        self::assertSame('01_Song_04.md', $song04->getFile());
        self::assertSame('song-04', $song04->getPath());

        self::assertSame('Song 05', $song05->getName());
        self::assertSame('02_Song_05.md', $song05->getFile());
        self::assertSame('song-05', $song05->getPath());

        self::assertSame('Song 06', $song06->getName());
        self::assertSame('03_Song_06.md', $song06->getFile());
        self::assertSame('song-06', $song06->getPath());

        $text01 = $song01->getText();
        $text02 = $song02->getText();
        $text03 = $song03->getText();
        $text04 = $song04->getText();
        $text05 = $song05->getText();
        $text06 = $song06->getText();

        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text01->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text02->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text03->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text04->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text05->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text06->getMarkdown());
    }

    public function testGetDisc(): void
    {
        $dic = static::getContainer();

        /** @var DiscRepository $discRepository */
        $discRepository = $dic->get(DiscRepository::class);

        $disc = $discRepository->getDisc('band-1', 'disc-1');

        if ($disc instanceof Disc === false) {
            self::fail(
                \sprintf(
                    'Failed to assert that $band is %s. It is %s instead.',
                    Disc::class,
                    \gettype($disc)
                )
            );
        }

        $songs = $disc->getSongs();

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

    public function testGetDiscReturnsNull(): void
    {
        $dic = static::getContainer();

        /** @var DiscRepository $discRepository */
        $discRepository = $dic->get(DiscRepository::class);

        $disc = $discRepository->getDisc('band-1', 'disc-x');

        self::assertNull($disc);
    }
}
