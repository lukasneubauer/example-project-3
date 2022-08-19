<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Renderers\HomeRenderer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController
{
    public function __construct(
        private HomeRenderer $homeRenderer,
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
            path: '/',
            name: 'home'
        )
    ]
    public function index(): Response
    {
        return new Response($this->homeRenderer->render($this->environment === 'prod'));
    }
}
