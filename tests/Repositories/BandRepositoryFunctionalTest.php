<?php

declare(strict_types=1);

namespace Tests\App\Repositories;

use App\Entities\Band;
use App\Repositories\BandRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BandRepositoryFunctionalTest extends WebTestCase
{
    public function testGetBands(): void
    {
        $dic = static::getContainer();

        /** @var BandRepository $bandRepository */
        $bandRepository = $dic->get(BandRepository::class);

        $bands = $bandRepository->getBands();

        $band1 = $bands['band-1'];
        $band2 = $bands['band-2'];

        self::assertSame('Band 1', $band1->getName());
        self::assertSame('Band_1', $band1->getDirectory());
        self::assertSame('band-1', $band1->getPath());

        self::assertSame('Band 2', $band2->getName());
        self::assertSame('Band_2', $band2->getDirectory());
        self::assertSame('band-2', $band2->getPath());

        $discs = $band1->getDiscs();

        $disc1 = $discs['disc-1'];
        $disc2 = $discs['disc-2'];

        self::assertSame('Disc 1', $disc1->getName());
        self::assertSame('2001_Disc_1', $disc1->getDirectory());
        self::assertSame('disc-1', $disc1->getPath());

        self::assertSame('Disc 2', $disc2->getName());
        self::assertSame('2002_Disc_2', $disc2->getDirectory());
        self::assertSame('disc-2', $disc2->getPath());

        $discs = $band2->getDiscs();

        $disc3 = $discs['disc-3'];
        $disc4 = $discs['disc-4'];

        self::assertSame('Disc 3', $disc3->getName());
        self::assertSame('2003_Disc_3', $disc3->getDirectory());
        self::assertSame('disc-3', $disc3->getPath());

        self::assertSame('Disc 4', $disc4->getName());
        self::assertSame('2004_Disc_4', $disc4->getDirectory());
        self::assertSame('disc-4', $disc4->getPath());

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

        $songs = $disc3->getSongs();

        $song07 = $songs['song-07'];
        $song08 = $songs['song-08'];
        $song09 = $songs['song-09'];

        self::assertSame('Song 07', $song07->getName());
        self::assertSame('01_Song_07.md', $song07->getFile());
        self::assertSame('song-07', $song07->getPath());

        self::assertSame('Song 08', $song08->getName());
        self::assertSame('02_Song_08.md', $song08->getFile());
        self::assertSame('song-08', $song08->getPath());

        self::assertSame('Song 09', $song09->getName());
        self::assertSame('03_Song_09.md', $song09->getFile());
        self::assertSame('song-09', $song09->getPath());

        $songs = $disc4->getSongs();

        $song10 = $songs['song-10'];
        $song11 = $songs['song-11'];
        $song12 = $songs['song-12'];

        self::assertSame('Song 10', $song10->getName());
        self::assertSame('01_Song_10.md', $song10->getFile());
        self::assertSame('song-10', $song10->getPath());

        self::assertSame('Song 11', $song11->getName());
        self::assertSame('02_Song_11.md', $song11->getFile());
        self::assertSame('song-11', $song11->getPath());

        self::assertSame('Song 12', $song12->getName());
        self::assertSame('03_Song_12.md', $song12->getFile());
        self::assertSame('song-12', $song12->getPath());

        $text01 = $song01->getText();
        $text02 = $song02->getText();
        $text03 = $song03->getText();
        $text04 = $song04->getText();
        $text05 = $song05->getText();
        $text06 = $song06->getText();
        $text07 = $song07->getText();
        $text08 = $song08->getText();
        $text09 = $song09->getText();
        $text10 = $song10->getText();
        $text11 = $song11->getText();
        $text12 = $song12->getText();

        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text01->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text02->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text03->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text04->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text05->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text06->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text07->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text08->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text09->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text10->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text11->getMarkdown());
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text12->getMarkdown());
    }

    public function testGetBand(): void
    {
        $dic = static::getContainer();

        /** @var BandRepository $bandRepository */
        $bandRepository = $dic->get(BandRepository::class);

        $band = $bandRepository->getBand('band-1');

        if ($band instanceof Band === false) {
            self::fail(
                \sprintf(
                    'Failed to assert that $band is %s. It is %s instead.',
                    Band::class,
                    \gettype($band)
                )
            );
        }

        self::assertSame('Band 1', $band->getName());
        self::assertSame('Band_1', $band->getDirectory());
        self::assertSame('band-1', $band->getPath());

        $discs = $band->getDiscs();

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

    public function testGetBandReturnsNull(): void
    {
        $dic = static::getContainer();

        /** @var BandRepository $bandRepository */
        $bandRepository = $dic->get(BandRepository::class);

        $band = $bandRepository->getBand('band-x');

        self::assertNull($band);
    }
}
