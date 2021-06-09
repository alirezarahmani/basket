<?php
declare(strict_types=1);

namespace App\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Quantity   implements \JsonSerializable
{
    private int $quantity;

    /**
     * Quantity constructor.
     * @param int $quantity
     * @throws AssertionFailedException
     */
    public function __construct(int $quantity)
    {
        Assertion::greaterThan($quantity, 0, 'make sure your integer is bigger than zero');
        $this->quantity = $quantity;
    }

    #[Pure] public function compareTo(Quantity $other): bool
    {
        return $this->quantity === $other->amount();
    }

    #[Pure] public function equals(Quantity $other): bool
    {
        return $this->compareTo($other) == 0;
    }

    public function amount(): int
    {
        return $this->quantity;
    }

    #[ArrayShape(['amount' => "int"])] public function jsonSerialize(): array
    {
        return [
            'amount'   => $this->quantity,
        ];
    }
}