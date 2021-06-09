<?php
declare(strict_types=1);

namespace App\Domain;

use App\Exceptions\OutOfStockProductException;
use App\ValueObject\Quantity;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class Item
{
    private int $id;

    private Product $product;

    private Money $price;

    private Quantity $quantity;

    private Basket $basket;

    public function __construct()
    {
        $this->price = new Money(0, new Currency('USD'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        $this->price = $product->getPrice();
        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    public function setQuantity(Quantity $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(Basket $basket): self
    {
        $this->basket = $basket;
        return $this;
    }


    public function validateQuantity(): void
    {
        if ($this->getQuantity()->amount() > $this->product->getStock()->amount()) {
            throw new OutOfStockProductException('you can not order more than stock');
        }
    }
}
