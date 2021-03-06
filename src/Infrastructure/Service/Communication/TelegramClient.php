<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Infrastructure\Service\Communication;

use AdnanMula\Chronogg\Notifier\Domain\Service\Communication\CommunicationClient;
use AdnanMula\Telegram\SendMessage\TelegramClient as Client;

final class TelegramClient implements CommunicationClient
{
    private Client $client;

    public function __construct(string $token)
    {
        $this->client = new Client($token);
    }

    public function say(string $msg, string $to): void
    {
        $this->client->sendMessage($to, $msg);
    }
}
