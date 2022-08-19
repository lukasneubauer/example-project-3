<?php

declare(strict_types=1);

namespace Tests\App\Database;

use App\Database\Access;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AccessFunctionalTest extends WebTestCase
{
    public function testGetBands(): void
    {
        $dic = static::getContainer();

        /** @var Access $access */
        $access = $dic->get(Access::class);

        $bands = $access->getBands();
        self::assertIsArray($bands);
        self::assertCount(2, $bands);
        $band1 = $bands['band-1'];
        self::assertSame('Band 1', $band1->getName());
        self::assertSame('Band_1', $band1->getDirectory());
        self::assertSame('band-1', $band1->getPath());
        $band2 = $bands['band-2'];
        self::assertSame('Band 2', $band2->getName());
        self::assertSame('Band_2', $band2->getDirectory());
        self::assertSame('band-2', $band2->getPath());

        $discs = $band1->getDiscs();
        self::assertIsArray($discs);
        self::assertCount(2, $discs);
        $disc1 = $discs['disc-1'];
        self::assertSame('Disc 1', $disc1->getName());
        self::assertSame('2001_Disc_1', $disc1->getDirectory());
        self::assertSame('disc-1', $disc1->getPath());
        $disc2 = $discs['disc-2'];
        self::assertSame('Disc 2', $disc2->getName());
        self::assertSame('2002_Disc_2', $disc2->getDirectory());
        self::assertSame('disc-2', $disc2->getPath());

        $discs = $band2->getDiscs();
        self::assertIsArray($discs);
        self::assertCount(2, $discs);
        $disc3 = $discs['disc-3'];
        self::assertSame('Disc 3', $disc3->getName());
        self::assertSame('2003_Disc_3', $disc3->getDirectory());
        self::assertSame('disc-3', $disc3->getPath());
        $disc4 = $discs['disc-4'];
        self::assertSame('Disc 4', $disc4->getName());
        self::assertSame('2004_Disc_4', $disc4->getDirectory());
        self::assertSame('disc-4', $disc4->getPath());

        $songs = $disc1->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song01 = $songs['song-01'];
        self::assertSame('Song 01', $song01->getName());
        self::assertSame('01_Song_01.md', $song01->getFile());
        self::assertSame('song-01', $song01->getPath());
        $song02 = $songs['song-02'];
        self::assertSame('Song 02', $song02->getName());
        self::assertSame('02_Song_02.md', $song02->getFile());
        self::assertSame('song-02', $song02->getPath());
        $song03 = $songs['song-03'];
        self::assertSame('Song 03', $song03->getName());
        self::assertSame('03_Song_03.md', $song03->getFile());
        self::assertSame('song-03', $song03->getPath());

        $songs = $disc2->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song04 = $songs['song-04'];
        self::assertSame('Song 04', $song04->getName());
        self::assertSame('01_Song_04.md', $song04->getFile());
        self::assertSame('song-04', $song04->getPath());
        $song05 = $songs['song-05'];
        self::assertSame('Song 05', $song05->getName());
        self::assertSame('02_Song_05.md', $song05->getFile());
        self::assertSame('song-05', $song05->getPath());
        $song06 = $songs['song-06'];
        self::assertSame('Song 06', $song06->getName());
        self::assertSame('03_Song_06.md', $song06->getFile());
        self::assertSame('song-06', $song06->getPath());

        $songs = $disc3->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song07 = $songs['song-07'];
        self::assertSame('Song 07', $song07->getName());
        self::assertSame('01_Song_07.md', $song07->getFile());
        self::assertSame('song-07', $song07->getPath());
        $song08 = $songs['song-08'];
        self::assertSame('Song 08', $song08->getName());
        self::assertSame('02_Song_08.md', $song08->getFile());
        self::assertSame('song-08', $song08->getPath());
        $song09 = $songs['song-09'];
        self::assertSame('Song 09', $song09->getName());
        self::assertSame('03_Song_09.md', $song09->getFile());
        self::assertSame('song-09', $song09->getPath());

        $songs = $disc4->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song10 = $songs['song-10'];
        self::assertSame('Song 10', $song10->getName());
        self::assertSame('01_Song_10.md', $song10->getFile());
        self::assertSame('song-10', $song10->getPath());
        $song11 = $songs['song-11'];
        self::assertSame('Song 11', $song11->getName());
        self::assertSame('02_Song_11.md', $song11->getFile());
        self::assertSame('song-11', $song11->getPath());
        $song12 = $songs['song-12'];
        self::assertSame('Song 12', $song12->getName());
        self::assertSame('03_Song_12.md', $song12->getFile());
        self::assertSame('song-12', $song12->getPath());

        $text01 = $song01->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text01->getMarkdown());
        $text02 = $song02->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text02->getMarkdown());
        $text03 = $song03->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text03->getMarkdown());
        $text04 = $song04->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text04->getMarkdown());
        $text05 = $song05->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text05->getMarkdown());
        $text06 = $song06->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text06->getMarkdown());
        $text07 = $song07->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text07->getMarkdown());
        $text08 = $song08->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text08->getMarkdown());
        $text09 = $song09->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text09->getMarkdown());
        $text10 = $song10->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text10->getMarkdown());
        $text11 = $song11->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text11->getMarkdown());
        $text12 = $song12->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text12->getMarkdown());
    }

    public function testGetDiscs(): void
    {
        $dic = static::getContainer();

        /** @var Access $access */
        $access = $dic->get(Access::class);

        $discs = $access->getDiscs('Band_1');
        self::assertIsArray($discs);
        self::assertCount(2, $discs);
        $disc1 = $discs['disc-1'];
        self::assertSame('Disc 1', $disc1->getName());
        self::assertSame('2001_Disc_1', $disc1->getDirectory());
        self::assertSame('disc-1', $disc1->getPath());
        $disc2 = $discs['disc-2'];
        self::assertSame('Disc 2', $disc2->getName());
        self::assertSame('2002_Disc_2', $disc2->getDirectory());
        self::assertSame('disc-2', $disc2->getPath());

        $discs = $access->getDiscs('Band_2');
        self::assertIsArray($discs);
        self::assertCount(2, $discs);
        $disc3 = $discs['disc-3'];
        self::assertSame('Disc 3', $disc3->getName());
        self::assertSame('2003_Disc_3', $disc3->getDirectory());
        self::assertSame('disc-3', $disc3->getPath());
        $disc4 = $discs['disc-4'];
        self::assertSame('Disc 4', $disc4->getName());
        self::assertSame('2004_Disc_4', $disc4->getDirectory());
        self::assertSame('disc-4', $disc4->getPath());

        $songs = $disc1->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song01 = $songs['song-01'];
        self::assertSame('Song 01', $song01->getName());
        self::assertSame('01_Song_01.md', $song01->getFile());
        self::assertSame('song-01', $song01->getPath());
        $song02 = $songs['song-02'];
        self::assertSame('Song 02', $song02->getName());
        self::assertSame('02_Song_02.md', $song02->getFile());
        self::assertSame('song-02', $song02->getPath());
        $song03 = $songs['song-03'];
        self::assertSame('Song 03', $song03->getName());
        self::assertSame('03_Song_03.md', $song03->getFile());
        self::assertSame('song-03', $song03->getPath());

        $songs = $disc2->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song04 = $songs['song-04'];
        self::assertSame('Song 04', $song04->getName());
        self::assertSame('01_Song_04.md', $song04->getFile());
        self::assertSame('song-04', $song04->getPath());
        $song05 = $songs['song-05'];
        self::assertSame('Song 05', $song05->getName());
        self::assertSame('02_Song_05.md', $song05->getFile());
        self::assertSame('song-05', $song05->getPath());
        $song06 = $songs['song-06'];
        self::assertSame('Song 06', $song06->getName());
        self::assertSame('03_Song_06.md', $song06->getFile());
        self::assertSame('song-06', $song06->getPath());

        $songs = $disc3->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song07 = $songs['song-07'];
        self::assertSame('Song 07', $song07->getName());
        self::assertSame('01_Song_07.md', $song07->getFile());
        self::assertSame('song-07', $song07->getPath());
        $song08 = $songs['song-08'];
        self::assertSame('Song 08', $song08->getName());
        self::assertSame('02_Song_08.md', $song08->getFile());
        self::assertSame('song-08', $song08->getPath());
        $song09 = $songs['song-09'];
        self::assertSame('Song 09', $song09->getName());
        self::assertSame('03_Song_09.md', $song09->getFile());
        self::assertSame('song-09', $song09->getPath());

        $songs = $disc4->getSongs();
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song10 = $songs['song-10'];
        self::assertSame('Song 10', $song10->getName());
        self::assertSame('01_Song_10.md', $song10->getFile());
        self::assertSame('song-10', $song10->getPath());
        $song11 = $songs['song-11'];
        self::assertSame('Song 11', $song11->getName());
        self::assertSame('02_Song_11.md', $song11->getFile());
        self::assertSame('song-11', $song11->getPath());
        $song12 = $songs['song-12'];
        self::assertSame('Song 12', $song12->getName());
        self::assertSame('03_Song_12.md', $song12->getFile());
        self::assertSame('song-12', $song12->getPath());

        $text01 = $song01->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text01->getMarkdown());
        $text02 = $song02->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text02->getMarkdown());
        $text03 = $song03->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text03->getMarkdown());
        $text04 = $song04->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text04->getMarkdown());
        $text05 = $song05->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text05->getMarkdown());
        $text06 = $song06->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text06->getMarkdown());
        $text07 = $song07->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text07->getMarkdown());
        $text08 = $song08->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text08->getMarkdown());
        $text09 = $song09->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text09->getMarkdown());
        $text10 = $song10->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text10->getMarkdown());
        $text11 = $song11->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text11->getMarkdown());
        $text12 = $song12->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text12->getMarkdown());
    }

    public function testGetSongs(): void
    {
        $dic = static::getContainer();

        /** @var Access $access */
        $access = $dic->get(Access::class);

        $songs = $access->getSongs('Band_1', '2001_Disc_1');
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song01 = $songs['song-01'];
        self::assertSame('Song 01', $song01->getName());
        self::assertSame('01_Song_01.md', $song01->getFile());
        self::assertSame('song-01', $song01->getPath());
        $song02 = $songs['song-02'];
        self::assertSame('Song 02', $song02->getName());
        self::assertSame('02_Song_02.md', $song02->getFile());
        self::assertSame('song-02', $song02->getPath());
        $song03 = $songs['song-03'];
        self::assertSame('Song 03', $song03->getName());
        self::assertSame('03_Song_03.md', $song03->getFile());
        self::assertSame('song-03', $song03->getPath());

        $songs = $access->getSongs('Band_1', '2002_Disc_2');
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song04 = $songs['song-04'];
        self::assertSame('Song 04', $song04->getName());
        self::assertSame('01_Song_04.md', $song04->getFile());
        self::assertSame('song-04', $song04->getPath());
        $song05 = $songs['song-05'];
        self::assertSame('Song 05', $song05->getName());
        self::assertSame('02_Song_05.md', $song05->getFile());
        self::assertSame('song-05', $song05->getPath());
        $song06 = $songs['song-06'];
        self::assertSame('Song 06', $song06->getName());
        self::assertSame('03_Song_06.md', $song06->getFile());
        self::assertSame('song-06', $song06->getPath());

        $songs = $access->getSongs('Band_2', '2003_Disc_3');
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song07 = $songs['song-07'];
        self::assertSame('Song 07', $song07->getName());
        self::assertSame('01_Song_07.md', $song07->getFile());
        self::assertSame('song-07', $song07->getPath());
        $song08 = $songs['song-08'];
        self::assertSame('Song 08', $song08->getName());
        self::assertSame('02_Song_08.md', $song08->getFile());
        self::assertSame('song-08', $song08->getPath());
        $song09 = $songs['song-09'];
        self::assertSame('Song 09', $song09->getName());
        self::assertSame('03_Song_09.md', $song09->getFile());
        self::assertSame('song-09', $song09->getPath());

        $songs = $access->getSongs('Band_2', '2004_Disc_4');
        self::assertIsArray($songs);
        self::assertCount(3, $songs);
        $song10 = $songs['song-10'];
        self::assertSame('Song 10', $song10->getName());
        self::assertSame('01_Song_10.md', $song10->getFile());
        self::assertSame('song-10', $song10->getPath());
        $song11 = $songs['song-11'];
        self::assertSame('Song 11', $song11->getName());
        self::assertSame('02_Song_11.md', $song11->getFile());
        self::assertSame('song-11', $song11->getPath());
        $song12 = $songs['song-12'];
        self::assertSame('Song 12', $song12->getName());
        self::assertSame('03_Song_12.md', $song12->getFile());
        self::assertSame('song-12', $song12->getPath());

        $text01 = $song01->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text01->getMarkdown());
        $text02 = $song02->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text02->getMarkdown());
        $text03 = $song03->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text03->getMarkdown());
        $text04 = $song04->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text04->getMarkdown());
        $text05 = $song05->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text05->getMarkdown());
        $text06 = $song06->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text06->getMarkdown());
        $text07 = $song07->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text07->getMarkdown());
        $text08 = $song08->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text08->getMarkdown());
        $text09 = $song09->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text09->getMarkdown());
        $text10 = $song10->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text10->getMarkdown());
        $text11 = $song11->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text11->getMarkdown());
        $text12 = $song12->getText();
        self::assertSame('Lazy operation! Text will be initialized only when necessary.', $text12->getMarkdown());
    }

    public function testGetText(): void
    {
        $dic = static::getContainer();

        /** @var Access $access */
        $access = $dic->get(Access::class);

        $markdown = <<<EOL
Lorem ipsum dolor sit amet,

consectetur adipiscing elit,

sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

Purus faucibus ornare suspendisse sed nisi lacus sed viverra tellus.

<br>

Egestas dui id ornare arcu.

Varius vel pharetra vel turpis nunc eget lorem dolor sed.

Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.

Praesent elementum facilisis leo vel fringilla est.

<br>

Varius sit amet mattis vulputate enim nulla.

Justo nec ultrices dui sapien eget mi proin sed libero.

Egestas sed sed risus pretium quam vulputate.

Eu augue ut lectus arcu bibendum.

EOL;

        $text01 = $access->getText('Band_1', '2001_Disc_1', '01_Song_01.md');
        self::assertSame($markdown, $text01->getMarkdown());
        $text02 = $access->getText('Band_1', '2001_Disc_1', '02_Song_02.md');
        self::assertSame($markdown, $text02->getMarkdown());
        $text03 = $access->getText('Band_1', '2001_Disc_1', '03_Song_03.md');
        self::assertSame($markdown, $text03->getMarkdown());
        $text04 = $access->getText('Band_1', '2002_Disc_2', '01_Song_04.md');
        self::assertSame($markdown, $text04->getMarkdown());
        $text05 = $access->getText('Band_1', '2002_Disc_2', '02_Song_05.md');
        self::assertSame($markdown, $text05->getMarkdown());
        $text06 = $access->getText('Band_1', '2002_Disc_2', '03_Song_06.md');
        self::assertSame($markdown, $text06->getMarkdown());
        $text07 = $access->getText('Band_2', '2003_Disc_3', '01_Song_07.md');
        self::assertSame($markdown, $text07->getMarkdown());
        $text08 = $access->getText('Band_2', '2003_Disc_3', '02_Song_08.md');
        self::assertSame($markdown, $text08->getMarkdown());
        $text09 = $access->getText('Band_2', '2003_Disc_3', '03_Song_09.md');
        self::assertSame($markdown, $text09->getMarkdown());
        $text10 = $access->getText('Band_2', '2004_Disc_4', '01_Song_10.md');
        self::assertSame($markdown, $text10->getMarkdown());
        $text11 = $access->getText('Band_2', '2004_Disc_4', '02_Song_11.md');
        self::assertSame($markdown, $text11->getMarkdown());
        $text12 = $access->getText('Band_2', '2004_Disc_4', '03_Song_12.md');
        self::assertSame($markdown, $text12->getMarkdown());
    }
}
