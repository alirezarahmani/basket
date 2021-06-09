<?php
declare(strict_types=1);

namespace App\Domain;

use App\ValueObject\Stock;
use SebastianBergmann\Money\Money;

class Product
{
    private int $id;
    private string $name;
    private ?Stock $stock = null;
    private ?string $description;
    private ?Money $price = null;
    private int $number;
    private MediaObject $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }


    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getPrice(): ?Money
    {
        return $this->price;
    }

    public function setPrice(?Money $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function setNumber(int $param): self
    {
        $this->number = $param;
        return $this;
    }

    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    public function getImageUrl(): string
    {
       return $this->getImage()->getContentUrl();
    }

    public function setImage(MediaObject $image): self
    {
        $this->image = $image;
        return $this;
    }
}
