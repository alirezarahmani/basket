<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\ValueObject\IP;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

final class IPDoctrineType extends TextType
{
    public function getName(): string
    {
        return 'ip';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPhpValue($value, AbstractPlatform $platform): IP
    {
        return new IP($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value->getIp();
    }
}