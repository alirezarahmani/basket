<?php
declare(strict_types=1);

namespace App\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;
use JetBrains\PhpStorm\ArrayShape;
use SebastianBergmann\Money\Money;

/**
 * Class Email
 * @package App\ValueObject
 */
class Email   implements \JsonSerializable
{
    private string $email;

    /**
     * Email constructor.
     * @param string $email
     * @throws AssertionFailedException
     */
    public function __construct(string $email)
    {
        Assertion::email($email, 'make sure, you have correct email address');
        $this->email = $email;
    }

    public function compareTo(Email $other)
    {
        return $this->email === $other->getEmail();
    }

    public function equals(Email $other): bool
    {
        return $this->compareTo($other) == 0;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    #[ArrayShape(['email' => "string"])] public function jsonSerialize(): array
    {
        return [
            'email' => $this->email
        ];
    }
}