<?php

declare(strict_types=1);

namespace App\CodingAlgorithm\Shannon;

use App\CodingAlgorithm\CodingAlgorithmEnum;
use App\CodingAlgorithm\CodingResult;

readonly class ShannonResult extends CodingResult
{
    public function __construct(
        string $encoded,
        private CodeTable $codeTable,
    ) {
        parent::__construct(
            encoded: $encoded,
            algorithm: CodingAlgorithmEnum::SHANNON
        );
    }

    public function getCodeTable(): CodeTable
    {
        return $this->codeTable;
    }
}
