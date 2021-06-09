<?php
declare(strict_types=1);

namespace App\ValueObject;

use Assert\Assertion;
use JetBrains\PhpStorm\Pure;

class IP
{
    private string $ip;

    public function __construct(string $ip)
    {
        Assertion::ipv4($ip, null,'ip is wrong ');
        $this->ip = $ip;
    }

    #[Pure] public function compareTo(IP $other)
    {
        return $this->ip === $other->getIp();
    }

    #[Pure] public function equals(Ip $other): bool
    {
        return $this->compareTo($other) == 0;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}