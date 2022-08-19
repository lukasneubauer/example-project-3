<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Access;
use App\Entities\Band;
use App\Entities\Disc;

class DiscRepository
{
    public function __construct(
        private Access $dao
    ) {
    }

    /**
     * @return array<string, Disc>
     */
    public function getDiscs(string $band): array
    {
        $bands = $this->dao->getBands();

        /** @var Band|null $b */
        $b = $bands[$band] ?? null;

        if ($b === null) {
            return [];
        }

        return $b->getDiscs();
    }

    public function getDisc(string $band, string $disc): ?Disc
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

        return $d;
    }
}
