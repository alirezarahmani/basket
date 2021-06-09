<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\ValueObject\Quantity;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class QuantityDoctrineType extends IntegerType
{
    public function getName(): string
    {
        return 'quantity';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPhpValue($value, AbstractPlatform $platform): Quantity
    {
        return new Quantity(intval($value));
    }

    /**
     * @param Quantity $value
     * @param AbstractPlatform $platform
     * @return int|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value->amount();
    }
}