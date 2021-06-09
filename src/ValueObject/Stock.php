<?php
declare(strict_types=1);

namespace App\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Stock  implements \JsonSerializable
{
    private int $stock;

    /**
     * Stock constructor.
     * @param int $stock
     * @throws AssertionFailedException
     */
    public function __construct(int $stock)
    {
        Assertion::greaterThan($stock, 0, 'make sure your integer is bigger than zero');
        $this->stock = $stock;
    }

    #[Pure] public function compareTo(Stock $other): bool
    {
        return $this->stock === $other->amount();
    }

    #[Pure] public function equals(Stock $other): bool
    {
        return $this->compareTo($other) == 0;
    }

    public function amount(): int
    {
        return $this->stock;
    }

    #[ArrayShape(['amount' => "int"])] public function jsonSerialize(): array
    {
        return [
            'amount'   => $this->stock,
        ];
    }
}