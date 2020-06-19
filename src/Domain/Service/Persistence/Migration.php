<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Service\Persistence;

interface Migration
{
    public function up(): void;
    public function down(): void;
}
