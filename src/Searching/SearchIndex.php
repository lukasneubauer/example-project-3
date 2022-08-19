<?php

declare(strict_types=1);

namespace App\Searching;

class SearchIndex
{
    /**
     * @var array<string, array<string, array<string, array<string, array<int, string>>>>> $data
     */
    private array $data = [];

    public function addItem(
        string $word,
        string $band,
        string $disc,
        string $song,
        string $path
    ): void {
        $this->addWord($word);
        $this->addBand($word, $band);
        $this->addDisc($word, $band, $disc);
        $this->addSong($word, $band, $disc, $song);
        $this->addPath($word, $band, $disc, $song, $path);
    }

    /**
     * @return array<string, array<string, array<string, array<string, array<int, string>>>>>
     */
    public function getData(): array
    {
        \ksort($this->data);

        return $this->data;
    }

    public function getJson(): string
    {
        $json = (string) \json_encode($this->getData());

        if ($json === '[]') {
            return '{}';
        }

        return $json;
    }

    private function addWord(string $word): void
    {
        if (\array_key_exists(
            $word,
            $this->data
        ) === false
        ) {
            $this->data[$word] = [];
        }
    }

    private function addBand(string $word, string $band): void
    {
        if (\array_key_exists(
            $band,
            $this->data[$word]
        ) === false
        ) {
            $this->data[$word][$band] = [];
        }
    }

    private function addDisc(string $word, string $band, string $disc): void
    {
        if (\array_key_exists(
            $disc,
            $this->data[$word][$band]
        ) === false
        ) {
            $this->data[$word][$band][$disc] = [];
        }
    }

    private function addSong(string $word, string $band, string $disc, string $song): void
    {
        if (\array_key_exists(
            $song,
            $this->data[$word][$band][$disc]
        ) === false
        ) {
            $this->data[$word][$band][$disc][$song] = [];
        }
    }

    private function addPath(string $word, string $band, string $disc, string $song, string $path): void
    {
        if (\in_array(
            $path,
            $this->data[$word][$band][$disc][$song],
            true
        ) === false
        ) {
            $this->data[$word][$band][$disc][$song][] = $path;
        }
    }
}
