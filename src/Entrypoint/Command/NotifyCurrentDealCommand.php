<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Entrypoint\Command;

use AdnanMula\Chronogg\Notifier\Domain\Service\Communication\CommunicationClient;
use AdnanMula\Chronogg\Notifier\Infrastructure\Chrono\ChronoClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class NotifyCurrentDealCommand extends Command
{
    private ChronoClient $chronoClient;
    private CommunicationClient $communicationClient;

    public function __construct(ChronoClient $chronoClient, CommunicationClient $communicationClient)
    {
        $this->chronoClient = $chronoClient;
        $this->communicationClient = $communicationClient;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Notifies current chrono.gg deal.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->chronoClient->currentDeal();
        $this->communicationClient->say('hi');
        dd('hola');
    }
}
