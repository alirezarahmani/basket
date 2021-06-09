<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

final class MoneyDoctrineType extends IntegerType
{
    public function getName(): string
    {
        return 'price';
    }

    public function convertToPhpValue($value, AbstractPlatform $platform): Money
    {
        return new Money(intval($value), new Currency('USD'));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?float
    {
        return $value->getAmount();
    }
}