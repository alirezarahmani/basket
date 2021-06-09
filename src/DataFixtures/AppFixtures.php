<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\Basket;
use App\Domain\MediaObject;
use App\Domain\Product;
use App\Domain\User;
use App\ValueObject\Email;
use App\ValueObject\Stock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\ValueObject\IP;

class AppFixtures extends Fixture
{
    public function __construct(private string $webDirectory)
    {
    }

    public function load(ObjectManager $manager)
    {
        $file = new UploadedFile(
            $this->webDirectory . 'images/product.png',
            'product.png'
        );
        $basket = new Basket();
        $manager->persist($basket);
        $manager->flush();

        $user = New User();
        $user->setName('test');
        $user->setEmail(new Email('test@test.com'));
        $user->setIp(new IP('127.0.0.1'));
        $user->setBasket($basket);
        $manager->persist($user);
        $manager->flush();



        $mediaObject = new MediaObject();
        $mediaObject->setContentUrl($file->getClientOriginalName());
        $mediaObject->setFilePath($file->getPath());
        $manager->persist($mediaObject);
        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setStock(new Stock(10));
            $product->setPrice(new Money(mt_rand(10, 100), new Currency('USD')));
            $product->setImage($mediaObject);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
