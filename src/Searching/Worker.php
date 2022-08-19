<?php

declare(strict_types=1);

namespace App\Searching;

use App\Entities\Band;
use App\Entities\Disc;
use App\Entities\Song;
use App\Entities\Text;
use App\Repositories\BandRepository;
use App\Repositories\DiscRepository;
use App\Repositories\SongRepository;
use App\Repositories\TextRepository;
use App\Sanitizers\BrHtmlTagRemovalSanitizer;
use App\Sanitizers\LineBreakToSpaceSanitizer;
use App\Sanitizers\MultipleSpacesToSingleSpaceSanitizer;
use App\Sanitizers\NonAlphanumericAndNonSpaceCharactersRemovalSanitizer;
use App\Sanitizers\ToLowercaseSanitizer;
use Exception;

class Worker
{
    private SearchIndex $searchIndex;

    public function __construct(
        private SearchIndexFactory $searchIndexFactory,
        private BrHtmlTagRemovalSanitizer $brHtmlTagRemovalSanitizer,
        private LineBreakToSpaceSanitizer $lineBreakToSpaceSanitizer,
        private MultipleSpacesToSingleSpaceSanitizer $multipleSpacesToSingleSpaceSanitizer,
        private NonAlphanumericAndNonSpaceCharactersRemovalSanitizer $nonAlphanumericAndNonSpaceCharactersRemovalSanitizer,
        private ToLowercaseSanitizer $toLowercaseSanitizer,
        private BandRepository $bandRepository,
        private DiscRepository $discRepository,
        private SongRepository $songRepository,
        private TextRepository $textRepository
    ) {
        $this->searchIndex = $this->searchIndexFactory->create();
    }

    /**
     * @throws Exception
     */
    public function createIndex(): string
    {
        $this->goThroughBands();

        return $this->searchIndex->getJson();
    }

    /**
     * @throws Exception
     */
    private function goThroughBands(): void
    {
        foreach ($this->bandRepository->getBands() as $band) {
            $this->goThroughDiscs($band);
        }
    }

    /**
     * @throws Exception
     */
    private function goThroughDiscs(Band $band): void
    {
        foreach ($this->discRepository->getDiscs($band->getPath()) as $disc) {
            $this->goThroughSongs($band, $disc);
        }
    }

    /**
     * @throws Exception
     */
    private function goThroughSongs(Band $band, Disc $disc): void
    {
        foreach ($this->songRepository->getSongs($band->getPath(), $disc->getPath()) as $song) {
            $this->lexicalizeText($band, $disc, $song);
        }
    }

    /**
     * @throws Exception
     */
    private function lexicalizeText(Band $band, Disc $disc, Song $song): void
    {
        $text = $this->textRepository->getText($band->getPath(), $disc->getPath(), $song->getPath());
        if ($text === null) {
            throw new Exception(\sprintf('Instance of %s class was not found.', Text::class));
        }
        $songText = $this->sanitize($text->getMarkdown());

        foreach (\explode(' ', $songText) as $word) {
            if ($word !== '') {
                $path = \sprintf(
                    '/%s/%s/%s',
                    $band->getPath(),
                    $disc->getPath(),
                    $song->getPath()
                );
                $this->searchIndex->addItem(
                    $word,
                    $band->getName(),
                    $disc->getName(),
                    $song->getName(),
                    $path
                );
            }
        }
    }

    private function sanitize(string $songText): string
    {
        $songText = $this->brHtmlTagRemovalSanitizer->removeBrHtmlTag($songText);
        $songText = $this->lineBreakToSpaceSanitizer->lineBreakToSpace($songText);
        $songText = $this->multipleSpacesToSingleSpaceSanitizer->multipleSpacesToSingleSpace($songText);
        $songText = $this->nonAlphanumericAndNonSpaceCharactersRemovalSanitizer->removeNonAlphanumericAndNonSpaceCharacters($songText);
        $songText = $this->toLowercaseSanitizer->toLowercase($songText);

        return $songText;
    }
}
