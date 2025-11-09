<?php

declare(strict_types=1);

namespace App\CodingAlgorithm;

readonly class CodingResult
{
    public function __construct(
        private string $encoded,
        private CodingAlgorithmEnum $algorithm,
    ) {
    }

    public function getEncoded(): string
    {
        return $this->encoded;
    }

    public function getAlgorithm(): CodingAlgorithmEnum
    {
        return $this->algorithm;
    }
}
