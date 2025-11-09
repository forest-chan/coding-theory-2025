<?php

declare(strict_types=1);

namespace App\CodingAlgorithm\Shannon;

use App\CodingAlgorithm\CodingAlgorithmInterface;
use App\CodingAlgorithm\CodingResult;

class Shannon implements CodingAlgorithmInterface
{
    public function encode(string $text): CodingResult
    {
        $charFrequencies = $this->calculateCharFrequencies($text);
        $charProbabilities = $this->calculateCharProbabilities($text, $charFrequencies);

        $codeTable = $this->buildCodeTable($charFrequencies, $charProbabilities);

        return new ShannonResult(
            encoded: $this->encodeTextWithCodeTable($text, $codeTable),
            codeTable: $codeTable,
        );
    }

    public function decode(CodingResult $result): string
    {
        if (!$result instanceof ShannonResult) {
            throw new \InvalidArgumentException('Incorrect result object type. Its must be ShannonResult type');
        }

        $buffer = '';
        $decoded = '';
        $encodedLength = mb_strlen($result->getEncoded());
        for ($i = 0; $i < $encodedLength; $i++) {
            $buffer .= $result->getEncoded()[$i];

            $char = $result->getCodeTable()->getCharByBinaryCode($buffer);
            if ($char !== null) {
                $decoded .= $char;
                $buffer = '';
            }
        }

        return $decoded;
    }

    private function calculateCharFrequencies(string $text): array
    {
        $charFrequencies = [];
        foreach (mb_str_split($text) as $char) {
            if (array_key_exists($char, $charFrequencies)) {
                $charFrequencies[$char]++;
            } else {
                $charFrequencies[$char] = 1;
            }
        }

        arsort($charFrequencies);

        return $charFrequencies;
    }

    private function calculateCharProbabilities(string $text, array $charFrequencies): array
    {
        $charProbabilities = [];
        $totalCharCount = mb_strlen($text);
        foreach ($charFrequencies as $char => $charFrequency) {
            $charProbabilities[$char] = $charFrequency / $totalCharCount;
        }

        return $charProbabilities;
    }

    private function buildCodeTable(array $charFrequencies, array $charProbabilities): CodeTable
    {
        $entries = [];
        $cumulativeProbability = 0.0;

        foreach ($charFrequencies as $char => $frequency) {
            $probability = $charProbabilities[$char] ?? 0;
            $codeLength = (int) ceil(-log($probability, 2));

            $binaryCode = $this->decimalToBinaryString($cumulativeProbability, $codeLength);

            $entries[] = new CodeTableEntry(
                char: $char,
                binaryCode: $binaryCode,
                charFrequency: $frequency,
                charProbability: $probability,
            );

            $cumulativeProbability += $probability;
        }

        return new CodeTable($entries);
    }

    private function decimalToBinaryString(float $decimal, int $length): string
    {
        $binary = '';
        for ($i = 0; $i < $length; $i++) {
            $decimal *= 2;

            if ($decimal >= 1) {
                $binary .= '1';
                --$decimal;
            } else {
                $binary .= '0';
            }
        }

        return $binary;
    }

    private function encodeTextWithCodeTable(string $text, CodeTable $codeTable) : string
    {
        $encoded = '';
        foreach (mb_str_split($text) as $char) {
            $binaryCode = $codeTable->getBinaryCodeByChar($char);

            $encoded .= $binaryCode;
        }

        return $encoded;
    }
}
