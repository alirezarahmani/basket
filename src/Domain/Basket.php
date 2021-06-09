<?php
declare(strict_types=1);

namespace App\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class Basket
{
    private int $id;

    private ?ArrayCollection $items = null;

    private Money $wholePrice;

    #[Pure] public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getItems(): ?Collection
    {
        return $this->items;
    }

    public function updateItem(Item $item): self
    {
        if (empty($this->items)) {
            $this->items = new ArrayCollection();
        }
        if ($this->items->contains($item)) {
            $this->removeItem($item);
        }
        $this->items[] = $item;
        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getBasket() === $this) {
                $item->setBasket(null);
            }
        }

        return $this;
    }

    public function getWholePrice(): Money
    {
        return $this->wholePrice;
    }

    public function updateWholePrice()
    {
        $price = 0;
        /** @var Item $item */
        foreach ($this->items as $item) {
            $price += $item->getPrice()->getAmount();
        }
        $this->wholePrice = new Money($price, new Currency('USD'));
    }
}
