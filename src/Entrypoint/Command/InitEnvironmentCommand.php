<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Entrypoint\Command;

use AdnanMula\Chronogg\Notifier\Domain\Service\Persistence\Migration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class InitEnvironmentCommand extends Command
{
    /** @var array<Migration> */
    private array $migrations;

    public function __construct(Migration ...$migration)
    {
        $this->migrations = $migration;

        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this->setDescription('Initialize environment');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $app = $this->getApplication();

        if (null === $app) {
            throw new \RuntimeException('Kernel not initialized');
        }

        $app->setAutoExit(false);

        $app->run($this->dropDatabaseCommand());
        $app->run($this->createDatabaseCommand());

        \array_walk(
            $this->migrations,
            function (Migration $migration) use ($output) {
                $migration->down();
                $migration->up();

                $output->writeln($this->migrationName($migration) . ' executed');
            },
        );

        return Command::SUCCESS;
    }

    private function dropDatabaseCommand(): ArrayInput
    {
        return new ArrayInput(
            [
                'command' => 'doctrine:database:drop',
                '--no-interaction',
                '--force' => true,
                '--if-exists' => true,
            ],
        );
    }

    private function createDatabaseCommand(): ArrayInput
    {
        return new ArrayInput(
            [
                'command' => 'doctrine:database:create',
                '--no-interaction',
            ],
        );
    }

    private function migrationName(Migration $migration): string
    {
        $migrationName = \explode('\\', \get_class($migration));

        return $migrationName[\array_key_last($migrationName) - 1] . ' '
            . $migrationName[\array_key_last($migrationName)];
    }
}
