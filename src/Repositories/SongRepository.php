<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Access;
use App\Entities\Band;
use App\Entities\Disc;
use App\Entities\Song;

class SongRepository
{
    public function __construct(
        private Access $dao
    ) {
    }

    /**
     * @return array<string, Song>
     */
    public function getSongs(string $band, string $disc): array
    {
        $bands = $this->dao->getBands();

        /** @var Band|null $b */
        $b = $bands[$band] ?? null;

        if ($b === null) {
            return [];
        }

        $discs = $b->getDiscs();

        /** @var Disc|null $d */
        $d = $discs[$disc] ?? null;

        if ($d === null) {
            return [];
        }

        return $d->getSongs();
    }

    public function getSong(string $band, string $disc, string $song): ?Song
    {
        $bands = $this->dao->getBands();

        /** @var Band|null $b */
        $b = $bands[$band] ?? null;

        if ($b === null) {
            return null;
        }

        $discs = $b->getDiscs();

        /** @var Disc|null $d */
        $d = $discs[$disc] ?? null;

        if ($d === null) {
            return null;
        }

        $songs = $d->getSongs();

        /** @var Song|null $s */
        $s = $songs[$song] ?? null;

        if ($s === null) {
            return null;
        }

        return $s;
    }
}
