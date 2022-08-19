<?php

declare(strict_types=1);

namespace Tests\App\Repositories;

use App\Entities\Text;
use App\Repositories\TextRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TextRepositoryFunctionalTest extends WebTestCase
{
    public function testGetText(): void
    {
        $dic = static::getContainer();

        /** @var TextRepository $textRepository */
        $textRepository = $dic->get(TextRepository::class);

        $text = $textRepository->getText('band-1', 'disc-1', 'song-01');

        if ($text instanceof Text === false) {
            self::fail(
                \sprintf(
                    'Failed to assert that $band is %s. It is %s instead.',
                    Text::class,
                    \gettype($text)
                )
            );
        }

        $markdown = <<<EOL
Lorem ipsum dolor sit amet,

consectetur adipiscing elit,

sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

Purus faucibus ornare suspendisse sed nisi lacus sed viverra tellus.

<br>

Egestas dui id ornare arcu.

Varius vel pharetra vel turpis nunc eget lorem dolor sed.

Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.

Praesent elementum facilisis leo vel fringilla est.

<br>

Varius sit amet mattis vulputate enim nulla.

Justo nec ultrices dui sapien eget mi proin sed libero.

Egestas sed sed risus pretium quam vulputate.

Eu augue ut lectus arcu bibendum.

EOL;

        self::assertSame($markdown, $text->getMarkdown());
    }

    public function testGetTextReturnsNull(): void
    {
        $dic = static::getContainer();

        /** @var TextRepository $textRepository */
        $textRepository = $dic->get(TextRepository::class);

        $text = $textRepository->getText('band-1', 'disc-1', 'song-xy');

        self::assertNull($text);
    }
}
