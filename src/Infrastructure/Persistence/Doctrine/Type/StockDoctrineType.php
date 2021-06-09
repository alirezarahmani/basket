<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\ValueObject\Stock;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\FloatType;

final class StockDoctrineType extends FloatType
{
    public function getName(): string
    {
        return 'stock';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPhpValue($value, AbstractPlatform $platform): Stock
    {
        return (new Stock(intval($value)));
    }

    /**
     * @param Stock $value
     * @param AbstractPlatform $platform
     * @return int|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value->amount();
    }
}