<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\ValueObject\Email;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

final class EmailDoctrineType extends TextType
{
    public function getName(): string
    {
        return 'email';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPhpValue($value, AbstractPlatform $platform): Email
    {
        return new Email($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (is_string($value)) {
            return  $value;
        }
        return $value->getEmail();
    }
}