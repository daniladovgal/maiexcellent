<?php

namespace App\Common\V1\Kernel;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommonCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->setHistoryContext();
        return parent::execute($input, $output);
    }

    protected function setHistoryContext()
    {
        $cmdLine = $_SERVER['argv'] ?? [];

        Context::add('history', implode(' ', $cmdLine));
    }
}
