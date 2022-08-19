<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Access;
use App\Entities\Band;
use App\Entities\Disc;
use App\Entities\Song;
use App\Entities\Text;

class TextRepository
{
    public function __construct(
        private Access $dao
    ) {
    }

    public function getText(string $band, string $disc, string $song): ?Text
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

        return $this->dao->getText(
            $b->getDirectory(),
            $d->getDirectory(),
            $s->getFile()
        );
    }
}
