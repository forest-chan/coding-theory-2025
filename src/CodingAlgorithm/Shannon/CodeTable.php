<?php

declare(strict_types=1);

namespace App\CodingAlgorithm\Shannon;

readonly class CodeTable
{
    /** @param array<CodeTableEntry>  $codeTableEntries */
    public function __construct(
        private array $codeTableEntries
    ) {
    }

    public function getBinaryCodeByChar(string $char): ?string
    {
        foreach ($this->codeTableEntries as $entry) {
            if ($entry->getChar() === $char) {
                return $entry->getBinaryCode();
            }
        }

        return null;
    }

    public function getCharByBinaryCode(string $binaryCode): ?string
    {
        foreach ($this->codeTableEntries as $entry) {
            if ($entry->getBinaryCode() === $binaryCode) {
                return $entry->getChar();
            }
        }

        return null;
    }

    public function getCodeTableEntries(): array
    {
        return $this->codeTableEntries;
    }
}
