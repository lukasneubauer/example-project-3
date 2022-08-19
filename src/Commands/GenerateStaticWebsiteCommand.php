<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entities\Band;
use App\Entities\Disc;
use App\Exceptions\NotFoundException;
use App\Renderers\HomeRenderer;
use App\Renderers\SongRenderer;
use App\Repositories\BandRepository;
use App\Repositories\DiscRepository;
use App\Repositories\SongRepository;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GenerateStaticWebsiteCommand extends Command
{
    /** @var string */
    public const COMMAND_NAME = 'app:generate-static-website';

    /** @var string */
    public const OUTPUT_DIRECTORY = 'out';

    public function __construct(
        private string $projectDirectory,
        private BandRepository $bandRepository,
        private DiscRepository $discRepository,
        private SongRepository $songRepository,
        private HomeRenderer $homeRenderer,
        private SongRenderer $songRenderer
    ) {
        parent::__construct(self::COMMAND_NAME);
    }

    protected function configure(): void
    {
        $this->setDescription('Generate static version of the website.');
    }

    /**
     * @throws Exception
     * @throws LoaderError
     * @throws NotFoundException
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $environment = $input->getOption('env');

        if (\is_string($environment) === false) {
            throw new Exception("Couldn't get environment value as a string.");
        }

        $useMinified = $environment === 'prod';

        $this->generateHomePage($useMinified);

        foreach ($this->getCollection() as $path => $data) {
            $this->generateSongPage($path, $data, $useMinified);
        }

        $io = new SymfonyStyle($input, $output);
        $io->success("Static content was generated into the 'out' directory successfully.");

        return self::SUCCESS;
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private function generateHomePage(bool $useMinified): void
    {
        $html = $this->homeRenderer->render($useMinified);
        $directory = \sprintf('%s/%s', $this->projectDirectory, self::OUTPUT_DIRECTORY);
        $file = \sprintf('%s/%s', $directory, 'index.html');
        \file_put_contents($file, $html);
    }

    /**
     * @param array<string, string> $data
     * @throws LoaderError
     * @throws NotFoundException
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private function generateSongPage(string $path, array $data, bool $useMinified): void
    {
        $band = $data['band'];
        $disc = $data['disc'];
        $song = $data['song'];
        $html = $this->songRenderer->render($band, $disc, $song, $useMinified);
        $directory = \sprintf('%s/%s/%s', $this->projectDirectory, self::OUTPUT_DIRECTORY, $path);
        \mkdir($directory, 0775, true);
        $file = \sprintf('%s/%s', $directory, 'index.html');
        \file_put_contents($file, $html);
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function getCollection(): array
    {
        return $this->getBands();
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function getBands(): array
    {
        $list = [];

        foreach ($this->bandRepository->getBands() as $band) {
            $list = \array_merge(
                $list,
                $this->getDiscs($band)
            );
        }

        return $list;
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function getDiscs(Band $band): array
    {
        $list = [];

        foreach ($this->discRepository->getDiscs($band->getPath()) as $disc) {
            $list = \array_merge(
                $list,
                $this->getSongs($band, $disc)
            );
        }

        return $list;
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function getSongs(Band $band, Disc $disc): array
    {
        $list = [];

        foreach ($this->songRepository->getSongs($band->getPath(), $disc->getPath()) as $song) {
            $b = $band->getPath();
            $d = $disc->getPath();
            $s = $song->getPath();

            $path = \sprintf('%s/%s/%s', $b, $d, $s);

            $item = [
                $path => [
                    'band' => $b,
                    'disc' => $d,
                    'song' => $s,
                ],
            ];

            $list = \array_merge(
                $list,
                $item
            );
        }

        return $list;
    }
}
