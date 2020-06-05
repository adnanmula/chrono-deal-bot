<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Infrastructure\Communication;

use AdnanMula\Chronogg\Notifier\Domain\Service\Communication\CommunicationClient;
use DemigrantSoft\Telegram\SendMessage\TelegramClient as Client;

final class TelegramClient implements CommunicationClient
{
    private Client $client;
    private string $groupChatId;
    private string $adminChatId;

    public function __construct(string $token, string $groupChatId, string $adminChatId)
    {
        $this->client = new Client($token);

        $this->groupChatId = $groupChatId;
        $this->adminChatId = $adminChatId;
    }

    public function say(string $msg): void
    {
        $this->client->sendMessage($this->groupChatId, $msg);
    }

    public function log(string $msg): void
    {
        $this->client->sendMessage($this->adminChatId, $msg);
    }
}
