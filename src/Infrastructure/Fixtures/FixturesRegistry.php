<?php declare(strict_types=1);

namespace DemigrantSoft\ClockInBot\Infrastructure\Fixtures;

use DemigrantSoft\ClockInBot\Domain\Service\Persistence\Fixture;

final class FixturesRegistry
{
    private array $registry;

    public function __construct(Fixture ...$fixtures)
    {
        \array_walk(
            $fixtures,
            fn (Fixture $fixture) => $this->registry[\get_class($fixture)] = $fixture,
        );
    }

    public function execute(): void
    {
        \array_walk(
            $this->registry,
            fn (Fixture $fixture) => $this->load($fixture),
        );
    }

    private function load(Fixture $fixture): void
    {
        \array_walk(
            $fixture->dependants(),
            fn (string $fixture) => $this->load($this->registry[$fixture]),
        );

        if (false === $fixture->isLoaded()) {
            $fixture->load();
        }
    }
}
