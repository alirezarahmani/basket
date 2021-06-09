<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Domain\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UniqueNumber
{
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Product) {
            return;
        }

        $entityManager = $args->getObjectManager();
        $entity->setNumber($entity->getId() + 10000);
        $entityManager->persist($entity);
        $entityManager->flush();
    }
}