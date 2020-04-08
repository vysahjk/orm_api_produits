<?php

namespace App\EventSubscriber;

use DateTime;
use App\Entity\AbstractEntity;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EntityCreatedSubscriber implements EventSubscriber
{

  public function prePersist(LifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    if ($entity instanceof AbstractEntity) {
      // do something with the Car
      $entity->setCreated(new DateTime());
    
    }

  }

  public function getSubscribedEvents()
  {
    return [
      Events::prePersist
    ];
  }
}
