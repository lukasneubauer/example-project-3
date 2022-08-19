<?php

declare(strict_types=1);

namespace Tests\App\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\ResponseTester;

final class PageControllerFunctionalTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = self::createClient();

        $client->request('GET', '/band-1/disc-1/song-01');

        $response = $client->getResponse();

        ResponseTester::assertResponse(200, $response);

        self::assertSame('text/html; charset=UTF-8', $response->headers->get('Content-Type'));

        $content = (string) $response->getContent();

        self::assertStringContainsString('Lorem ipsum dolor sit amet,', $content);
        self::assertStringContainsString('consectetur adipiscing elit,', $content);
        self::assertStringContainsString('sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', $content);
        self::assertStringContainsString('Purus faucibus ornare suspendisse sed nisi lacus sed viverra tellus.', $content);
        self::assertStringContainsString('Egestas dui id ornare arcu.', $content);
        self::assertStringContainsString('Varius vel pharetra vel turpis nunc eget lorem dolor sed.', $content);
        self::assertStringContainsString('Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.', $content);
        self::assertStringContainsString('Praesent elementum facilisis leo vel fringilla est.', $content);
        self::assertStringContainsString('Varius sit amet mattis vulputate enim nulla.', $content);
        self::assertStringContainsString('Justo nec ultrices dui sapien eget mi proin sed libero.', $content);
        self::assertStringContainsString('Egestas sed sed risus pretium quam vulputate.', $content);
        self::assertStringContainsString('Eu augue ut lectus arcu bibendum.', $content);
    }

    public function testIndexReturnsNotFound(): void
    {
        $client = self::createClient();

        $client->request('GET', '/band-1/disc-1/song-xy');

        $response = $client->getResponse();

        ResponseTester::assertResponse(404, $response);

        self::assertSame('text/html; charset=UTF-8', $response->headers->get('Content-Type'));

        self::assertSame('Page not found.', (string) $response->getContent());
    }
}
