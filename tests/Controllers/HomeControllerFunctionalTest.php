<?php

declare(strict_types=1);

namespace Tests\App\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Tests\ResponseTester;

final class HomeControllerFunctionalTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = self::createClient();

        $dic = static::getContainer();

        /** @var Translator $translator */
        $translator = $dic->get('translator.default');

        $client->request('GET', '/');

        $response = $client->getResponse();

        ResponseTester::assertResponse(200, $response);

        self::assertSame('text/html; charset=UTF-8', $response->headers->get('Content-Type'));

        self::assertStringContainsString($translator->trans('welcome_prompt'), (string) $response->getContent());
    }
}
