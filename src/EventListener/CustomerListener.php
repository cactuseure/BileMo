<?php
namespace App\EventListener;

use App\Entity\Customer;
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;


class CustomerListener
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $user = $this->security->getUser();

        if (!$entity instanceof Customer || !$user instanceof User) {
            return;
        }

        $entity->setOwner($user);
    }
}
