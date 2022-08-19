<?php

declare(strict_types=1);

namespace App\Renderers;

use App\Exceptions\NotFoundException;
use App\Repositories\BandRepository;
use App\Repositories\DiscRepository;
use App\Repositories\SongRepository;
use App\Repositories\TextRepository;
use App\Searching\Worker;
use Exception;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class SongRenderer
{
    public function __construct(
        private string $template,
        private Twig $twig,
        private Worker $searchIndexWorker,
        private BandRepository $bandRepository,
        private DiscRepository $discRepository,
        private SongRepository $songRepository,
        private TextRepository $textRepository
    ) {
    }

    /**
     * @throws Exception
     * @throws LoaderError
     * @throws NotFoundException
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $band, string $disc, string $song, bool $useMinified): string
    {
        $b = $this->bandRepository->getBand($band);
        if ($b === null) {
            throw new NotFoundException();
        }

        $d = $this->discRepository->getDisc($band, $disc);
        if ($d === null) {
            throw new NotFoundException();
        }

        $s = $this->songRepository->getSong($band, $disc, $song);
        if ($s === null) {
            throw new NotFoundException();
        }

        $t = $this->textRepository->getText($band, $disc, $song);
        if ($t === null) {
            throw new NotFoundException();
        }

        return $this->twig->render(
            $this->template,
            [
                'useMinified' => $useMinified,
                'searchIndex' => $this->searchIndexWorker->createIndex(),
                'band' => $b->getName(),
                'disc' => $d->getName(),
                'song' => $s->getName(),
                'text' => $t->getMarkdown(),
            ]
        );
    }
}
