<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

/**
 *
 */
class UserRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return UserRepository::class;
    }
    public function findOneByEmail(string $email): User
    {
         if (null === $user = $this->objectRepository->findOneBy(['email'=> $email]))
         {
             throw UserNotFoundException::fromEmail($email);
         }
         return $user;
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }
}