<?php

declare(strict_types=1);

namespace App\CodingAlgorithm\Shannon;

readonly class CodeTableEntry
{
    public function __construct(
        private string $char,
        private string $binaryCode,
        private int $charFrequency,
        private float $charProbability,
    ) {
    }

    public function getChar(): string
    {
        return $this->char;
    }

    public function getBinaryCode(): string
    {
        return $this->binaryCode;
    }

    public function getCharFrequency(): int
    {
        return $this->charFrequency;
    }

    public function getCharProbability(): float
    {
        return $this->charProbability;
    }
}
