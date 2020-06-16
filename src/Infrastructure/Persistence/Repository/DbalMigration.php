<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Infrastructure\Persistence\Repository;

use AdnanMula\Chronogg\Notifier\Domain\Service\Persistence\Migration;
use Doctrine\DBAL\Connection;

abstract class DbalMigration implements Migration
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    abstract public function up(): void;

    abstract public function down(): void;
}
