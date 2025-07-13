<?php

namespace App\Command;

use App\Service\CurrencyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:update-currencies',
    description: 'Fetches and updates latest crypto data.',
)]
class UpdateCurrenciesCommand extends Command
{
    public function __construct(private CurrencyService $currencyService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Updating currencies...');

        $this->currencyService->fetchAndUpdateCurrencies();

        $output->writeln('Done.');
        return Command::SUCCESS;
    }
}
