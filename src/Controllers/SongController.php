<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Renderers\SongRenderer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class SongController
{
    public function __construct(
        private SongRenderer $songRenderer,
        private string $environment
    ) {
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    #[
        Route(
            path: '/{band}/{disc}/{song}',
            name: 'song'
        )
    ]
    public function index(string $band, string $disc, string $song): Response
    {
        try {
            return new Response($this->songRenderer->render($band, $disc, $song, $this->environment === 'prod'));
        } catch (NotFoundException $e) {
            return new Response($e->getMessage(), 404);
        }
    }
}
