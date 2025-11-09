<?php

declare(strict_types=1);

namespace App\Tests\CodingAlgorithm\Shannon;

use App\CodingAlgorithm\CodingAlgorithmEnum;
use App\CodingAlgorithm\CodingAlgorithmInterface;
use App\CodingAlgorithm\Shannon\CodeTable;
use App\CodingAlgorithm\Shannon\CodeTableEntry;
use App\CodingAlgorithm\Shannon\Shannon;
use App\CodingAlgorithm\Shannon\ShannonResult;
use App\Tests\Util\ConsoleTablePrinter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[TestDox('Shannon coding algorithm tests')]
class ShannonTest extends TestCase
{
    private CodingAlgorithmInterface $shannon;
    private ConsoleTablePrinter $consoleTablePrinter;

    #[DataProvider('ShannonEncodeDataProvider')]
    #[TestDox('Shannon encode --> text = $text, encoded result = $encoded')]
    public function testShannonEncode(
        string $text,
        string $encoded
    ): void {
        $actualResult = $this->shannon->encode($text);

        $this->printCodeTable($actualResult->getCodeTable());

        $this->assertSame($encoded, $actualResult->getEncoded());
        $this->assertSame(CodingAlgorithmEnum::SHANNON, $actualResult->getAlgorithm());
    }

    #[DataProvider('ShannonDecodeDataProvider')]
    #[TestDox('Shannon decode --> decoded result = $decoded')]
    public function testShannonDecode(
        ShannonResult $result,
        string $decoded
    ): void {
        $actualResult = $this->shannon->decode($result);

        $this->assertSame($decoded, $actualResult);
    }

    public static function ShannonEncodeDataProvider(): iterable
    {
        yield [
            'text' => 'hello world',
            'encoded' => '011110000000010101010110101101001110',
        ];
        yield [
            'text' => 'modern coding and information theory',
            'encoded' => '10100000011010110011100101001101110000110100000111100001001100000101100100100000111101000001111010011000110011000000001010011001111100101100000111111110',
        ];
    }

    public static function ShannonDecodeDataProvider(): iterable
    {
        yield [
            'result' => new ShannonResult(
                encoded: '011110000000010101010110101101001110',
                codeTable: new CodeTable([
                    new CodeTableEntry(
                        char: 'l',
                        binaryCode: '00',
                        charFrequency: 3,
                        charProbability: 0.2727
                    ),
                    new CodeTableEntry(
                        char: 'o',
                        binaryCode: '010',
                        charFrequency: 2,
                        charProbability: 0.1818
                    ),
                    new CodeTableEntry(
                        char: 'h',
                        binaryCode: '0111',
                        charFrequency: 1,
                        charProbability: 0.0909
                    ),
                    new CodeTableEntry(
                        char: 'e',
                        binaryCode: '1000',
                        charFrequency: 1,
                        charProbability: 0.0909
                    ),
                    new CodeTableEntry(
                        char: ' ',
                        binaryCode: '1010',
                        charFrequency: 1,
                        charProbability: 0.0909
                    ),
                    new CodeTableEntry(
                        char: 'w',
                        binaryCode: '1011',
                        charFrequency: 1,
                        charProbability: 0.0909
                    ),
                    new CodeTableEntry(
                        char: 'r',
                        binaryCode: '1101',
                        charFrequency: 1,
                        charProbability: 0.0909
                    ),
                    new CodeTableEntry(
                        char: 'd',
                        binaryCode: '1110',
                        charFrequency: 1,
                        charProbability: 0.0909
                    ),
                ])
            ),
            'decoded' => 'hello world',
        ];
        yield [
            'result' => new ShannonResult(
                encoded: '10100000011010110011100101001101110000110100000111100001001100000101100100100000111101000001111010011000110011000000001010011001111100101100000111111110',
                codeTable: new CodeTable([
                    new CodeTableEntry(
                        char: 'o',
                        binaryCode: '000',
                        charFrequency: 5,
                        charProbability: 0.1389
                    ),
                    new CodeTableEntry(
                        char: 'n',
                        binaryCode: '001',
                        charFrequency: 5,
                        charProbability: 0.1389
                    ),
                    new CodeTableEntry(
                        char: ' ',
                        binaryCode: '0100',
                        charFrequency: 4,
                        charProbability: 0.1111
                    ),
                    new CodeTableEntry(
                        char: 'd',
                        binaryCode: '0110',
                        charFrequency: 3,
                        charProbability: 0.0833
                    ),
                    new CodeTableEntry(
                        char: 'r',
                        binaryCode: '0111',
                        charFrequency: 3,
                        charProbability: 0.0833
                    ),
                    new CodeTableEntry(
                        char: 'i',
                        binaryCode: '1000',
                        charFrequency: 3,
                        charProbability: 0.0833
                    ),
                    new CodeTableEntry(
                        char: 'm',
                        binaryCode: '10100',
                        charFrequency: 2,
                        charProbability: 0.0556
                    ),
                    new CodeTableEntry(
                        char: 'e',
                        binaryCode: '10110',
                        charFrequency: 2,
                        charProbability: 0.0556
                    ),
                    new CodeTableEntry(
                        char: 'a',
                        binaryCode: '11000',
                        charFrequency: 2,
                        charProbability: 0.0556
                    ),
                    new CodeTableEntry(
                        char: 't',
                        binaryCode: '11001',
                        charFrequency: 2,
                        charProbability: 0.0556
                    ),
                    new CodeTableEntry(
                        char: 'c',
                        binaryCode: '110111',
                        charFrequency: 1,
                        charProbability: 0.0278
                    ),
                    new CodeTableEntry(
                        char: 'g',
                        binaryCode: '111000',
                        charFrequency: 1,
                        charProbability: 0.0278
                    ),
                    new CodeTableEntry(
                        char: 'f',
                        binaryCode: '111010',
                        charFrequency: 1,
                        charProbability: 0.0278
                    ),
                    new CodeTableEntry(
                        char: 'h',
                        binaryCode: '111100',
                        charFrequency: 1,
                        charProbability: 0.0278
                    ),
                    new CodeTableEntry(
                        char: 'y',
                        binaryCode: '111110',
                        charFrequency: 1,
                        charProbability: 0.0278
                    ),
                ])
            ),
            'decoded' => 'modern coding and information theory',
        ];
    }

    protected function setUp(): void
    {
        $this->shannon = new Shannon();
        $this->consoleTablePrinter = new ConsoleTablePrinter();
    }

    private function printCodeTable(CodeTable $codeTable): void
    {
        $data = [];
        foreach ($codeTable->getCodeTableEntries() as $entry) {
            $data[] = [
                'Char' => $entry->getChar(),
                'Binary Code' => $entry->getBinaryCode(),
                'Char Frequency' => $entry->getCharFrequency(),
                'Char Probability' => round($entry->getCharProbability(), 4),
            ];
        }

        $this->consoleTablePrinter->printTable($data);
    }
}
