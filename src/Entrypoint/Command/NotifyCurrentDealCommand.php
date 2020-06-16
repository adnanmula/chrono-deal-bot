<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Entrypoint\Command;

use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\Deal;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\UserRepository;
use AdnanMula\Chronogg\Notifier\Domain\Service\Communication\CommunicationClient;
use AdnanMula\Chronogg\Notifier\Infrastructure\Chrono\ChronoClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class NotifyCurrentDealCommand extends Command
{
    private ChronoClient $chronoClient;
    private CommunicationClient $communicationClient;
    private UserRepository $userRepository;

    public function __construct(ChronoClient $chronoClient, CommunicationClient $communicationClient, UserRepository $userRepository)
    {
        $this->chronoClient = $chronoClient;
        $this->communicationClient = $communicationClient;
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Notifies current chrono.gg deal to all subscribed users.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->userRepository->all();

        foreach ($users as $user) {
            $this->communicationClient->say(
                $this->messageFromDeal($this->chronoClient->currentDeal()), $user->reference()->value()
            );
        }

        return Command::SUCCESS;
    }

    private function messageFromDeal(?Deal $deal): string
    {
        return '[' . $deal->app()->name() . '](' . $deal->shop()->dealUrl() . ')' . ' esta a '
            . \round($deal->price()->salePrice()->getAmount() / 100, 2) . ' '
            . $deal->price()->currency()->getCode() . ' con un descuento del '
            . $deal->price()->discount()
            . '% (' . \round($deal->price()->normalPrice()->getAmount() / 100, 2) . ' '
            . $deal->price()->currency()->getCode() . ')';
    }
}
