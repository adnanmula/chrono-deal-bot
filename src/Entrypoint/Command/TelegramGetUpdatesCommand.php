<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Entrypoint\Command;

use AdnanMula\Chronogg\Notifier\Application\User\Subscribe\SubscribeUserCommand;
use AdnanMula\Chronogg\Notifier\Application\User\Unsubscribe\UnsubscribeUserCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class TelegramGetUpdatesCommand extends Command
{
    private string $botToken;
    private MessageBusInterface $bus;

    public function __construct(string $botToken, MessageBusInterface $bus)
    {
        $this->botToken = $botToken;

        parent::__construct(null);
        $this->bus = $bus;
    }

    protected function configure(): void
    {
        $this->setDescription('Process telegram messages');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = new \Telegram($this->botToken);

        $client->getUpdates();
        for ($i = 0; $i < $client->UpdateCount(); $i++) {
            $client->serveUpdate($i);

            $command = $this->getCommand($reference, $text);

            if (null === $command) {
                //TODO send unknown command
            } else {
                $this->bus->dispatch($command);
            }
        }

        return 0;
    }

    private function getCommand(string $reference, array $text)
    {
        $arguments = \explode(' ', $text['text']);

        $command = \array_shift($arguments);

        switch (true) {
            case (SubscribeUserCommand::COMMAND === $command):
                return $this->subscribeCommand($reference, $arguments);
            case (UnsubscribeUserCommand::COMMAND === $command):
                return $this->unSubscribeCommand($reference, $arguments);
            default:
                return null;
        }
    }

    private function subscribeCommand(string $reference, array $arguments): SubscribeUserCommand
    {
        return new SubscribeUserCommand($reference, $arguments[0], $arguments[1]);
    }

    private function unSubscribeCommand(string $reference, array $arguments): UnsubscribeUserCommand
    {
        return new UnsubscribeUserCommand($reference, $arguments[0]);
    }
}
