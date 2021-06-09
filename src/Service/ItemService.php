<?php
declare(strict_types=1);

namespace App\Service;

use App\Domain\Basket;
use App\Domain\Item;
use App\Domain\Product;
use App\Exceptions\ItemNotFoundException;
use App\Repository\BasketRepository;
use App\Repository\ItemRepository;
use App\Repository\ProductRepository;
use App\ValueObject\Quantity;
use Assert\Assertion;
use Assert\AssertionFailedException;
use JetBrains\PhpStorm\Pure;

class ItemService
{
    public function __construct(
        private ItemRepository $itemRepository,
        private ProductRepository $productRepository
    ) {
    }

    /**
     * @throws AssertionFailedException
     */
    public function updateItem(Basket $basket, int $productId, int $count = 1): void
    {
        $product = $this->productRepository->find($productId);
        Assertion::true(is_a($product, Product::class));
        $item = $this->itemRepository->findOneBy(['product' => $product, 'basket' => $basket]);
        if (!is_a($item, Item::class)) {
            $item = new Item();
            $item->setProduct($product);
            $item->setQuantity(new Quantity($count));
            $item->setBasket($basket);
        } else {
            $item->setQuantity(new Quantity($item->getQuantity()->amount() +$count));
        }
        $this->itemRepository->store($item);
    }

    /**
     * @throws AssertionFailedException
     */
    public function remove(Basket $basket, int $productId, int $count = 1): void
    {
        $product = $this->productRepository->find($productId);
        Assertion::true(is_a($product, Product::class));
        $item = $this->itemRepository->findOneBy(['product' => $product, 'basket' => $basket]);

        $quantity = $item->getQuantity()->amount() - $count;

        if ($quantity > 0) {
            $item->setQuantity(new Quantity($quantity));
            $this->itemRepository->store($item);
        } else {
            $this->itemRepository->remove($item);
        }
    }

    /**
     * @throws AssertionFailedException
     */
    public function getItem(Basket $basket, int $productId): Item
    {
        $product = $this->productRepository->find($productId);
        Assertion::true(is_a($product, Product::class));
        $item = $this->itemRepository->findOneBy(['product' => $product, 'basket' => $basket]);
        Assertion::true(is_a($item, Item::class));
        return $item;
    }
}