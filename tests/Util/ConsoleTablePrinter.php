<?php

declare(strict_types=1);

namespace App\Tests\Util;

use League\CLImate\CLImate;

class ConsoleTablePrinter
{
    private CLImate $printer;

    public function __construct()
    {
        $this->printer = new CLImate();
    }

    /** @param array<array<string, string> $data */
    public function printTable(array $data): void
    {
        $this->printer->table($data);
    }
}
