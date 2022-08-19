<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Access;
use App\Entities\Band;

class BandRepository
{
    public function __construct(
        private Access $dao
    ) {
    }

    /**
     * @return array<string, Band>
     */
    public function getBands(): array
    {
        return $this->dao->getBands();
    }

    public function getBand(string $band): ?Band
    {
        $bands = $this->dao->getBands();

        /** @var Band|null $b */
        $b = $bands[$band] ?? null;

        if ($b === null) {
            return null;
        }

        return $b;
    }
}
