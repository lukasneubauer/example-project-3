<?php

declare(strict_types=1);

namespace App\Database;

use App\Entities\Band;
use App\Entities\Disc;
use App\Entities\Song;
use App\Entities\Text;
use App\EntityFactories\BandFactory;
use App\EntityFactories\DiscFactory;
use App\EntityFactories\SongFactory;
use App\EntityFactories\TextFactory;
use App\Sanitizers\NonAlphanumericAndNonDashCharactersRemovalSanitizer;
use App\Sanitizers\SpaceToDashSanitizer;
use App\Sanitizers\UnderscoreToSpaceSanitizer;
use Symfony\Component\Finder\SplFileInfo;

class Access
{
    public function __construct(
        private Configuration $configuration,
        private Engine $engine,
        private NonAlphanumericAndNonDashCharactersRemovalSanitizer $nonAlphanumericAndNonDashCharactersRemovalSanitizer,
        private SpaceToDashSanitizer $spaceToDashSanitizer,
        private UnderscoreToSpaceSanitizer $underscoreToSpaceSanitizer,
        private BandFactory $bandFactory,
        private DiscFactory $discFactory,
        private SongFactory $songFactory,
        private TextFactory $textFactory
    ) {
    }

    /**
     * @return array<string, Band>
     */
    public function getBands(): array
    {
        $crawler = $this->engine->create();
        $crawler->in($this->configuration->getPath())
            ->directories()
            ->depth(0)
            ->sortByName();

        $bands = [];

        /** @var SplFileInfo $directory */
        foreach ($crawler as $directory) {
            $baseName = $directory->getBasename();
            $band = $this->underscoreToSpaceSanitizer->underscoreToSpace($baseName);
            $bandLower = \strtolower($band);
            $name = $this->spaceToDashSanitizer->spaceToDash($bandLower);
            $name = $this->nonAlphanumericAndNonDashCharactersRemovalSanitizer->removeNonAlphanumericAndNonDashCharacters($name);
            $bands[$name] = $this->bandFactory->create(
                $band,
                $baseName,
                $name,
                $this->getDiscs($baseName)
            );
        }

        return $bands;
    }

    /**
     * @return array<string, Disc>
     */
    public function getDiscs(string $bandDirectory): array
    {
        $crawler = $this->engine->create();
        $crawler->in(\sprintf('%s/%s', $this->configuration->getPath(), $bandDirectory))
            ->directories()
            ->depth(0)
            ->sortByName();

        $discs = [];

        /** @var SplFileInfo $directory */
        foreach ($crawler as $directory) {
            $baseName = $directory->getBasename();
            $discNoPrefix = \substr($baseName, 5);
            $disc = $this->underscoreToSpaceSanitizer->underscoreToSpace($discNoPrefix);
            $discLower = \strtolower($disc);
            $name = $this->spaceToDashSanitizer->spaceToDash($discLower);
            $name = $this->nonAlphanumericAndNonDashCharactersRemovalSanitizer->removeNonAlphanumericAndNonDashCharacters($name);
            $discs[$name] = $this->discFactory->create(
                $disc,
                $baseName,
                $name,
                $this->getSongs($bandDirectory, $baseName)
            );
        }

        return $discs;
    }

    /**
     * @return array<string, Song>
     */
    public function getSongs(string $bandDirectory, string $discDirectory): array
    {
        $crawler = $this->engine->create();
        $crawler->in(\sprintf('%s/%s/%s', $this->configuration->getPath(), $bandDirectory, $discDirectory))
            ->files()
            ->sortByName();

        $songs = [];

        /** @var SplFileInfo $file */
        foreach ($crawler as $file) {
            $baseName = $file->getBasename();
            $songNoPS = \substr($baseName, 3, -3);
            $song = $this->underscoreToSpaceSanitizer->underscoreToSpace($songNoPS);
            $songLower = \strtolower($song);
            $name = $this->spaceToDashSanitizer->spaceToDash($songLower);
            $name = $this->nonAlphanumericAndNonDashCharactersRemovalSanitizer->removeNonAlphanumericAndNonDashCharacters($name);
            $songs[$name] = $this->songFactory->create(
                $song,
                $baseName,
                $name,
                $this->textFactory->create('Lazy operation! Text will be initialized only when necessary.')
            );
        }

        return $songs;
    }

    public function getText(string $bandDirectory, string $discDirectory, string $songFile): Text
    {
        return $this->textFactory->create(
            (string) \file_get_contents(
                \sprintf(
                    '%s/%s/%s/%s',
                    $this->configuration->getPath(),
                    $bandDirectory,
                    $discDirectory,
                    $songFile
                )
            )
        );
    }
}
