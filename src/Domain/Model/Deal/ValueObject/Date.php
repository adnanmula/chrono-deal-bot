<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject;

final class Date
{
    private ?\DateTimeImmutable $start;
    private ?\DateTimeImmutable $end;

    private function __construct(?\DateTimeImmutable $start, ?\DateTimeImmutable $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public static function from(?\DateTimeImmutable $start, ?\DateTimeImmutable $end): self
    {
        return new self($start, $end);
    }

    public function start(): ?\DateTimeImmutable
    {
        return $this->start;
    }

    public function end(): ?\DateTimeImmutable
    {
        return $this->end;
    }
}
