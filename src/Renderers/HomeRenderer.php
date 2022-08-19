<?php

declare(strict_types=1);

namespace App\Renderers;

use App\Repositories\BandRepository;
use App\Searching\Worker;
use Exception;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeRenderer
{
    public function __construct(
        private string $template,
        private Twig $twig,
        private Worker $searchIndexWorker,
        private BandRepository $bandRepository
    ) {
    }

    /**
     * @throws Exception
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(bool $useMinified): string
    {
        return $this->twig->render(
            $this->template,
            [
                'useMinified' => $useMinified,
                'searchIndex' => $this->searchIndexWorker->createIndex(),
                'bands' => $this->bandRepository->getBands(),
            ]
        );
    }
}
