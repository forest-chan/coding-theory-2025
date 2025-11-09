<?php

declare(strict_types=1);

namespace App\CodingAlgorithm;

interface CodingAlgorithmInterface
{
    public function encode(string $text): CodingResult;

    public function decode(CodingResult $result): string;
}
