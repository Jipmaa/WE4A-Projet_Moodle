<?php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\Employee;

class MultiUserProvider implements UserProviderInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->entityManager->getRepository(Student::class)->findOneBy(['email' => $identifier])
            ?? $this->entityManager->getRepository(Teacher::class)->findOneBy(['email' => $identifier])
            ?? $this->entityManager->getRepository(Employee::class)->findOneBy(['email' => $identifier]);

        if (!$user) {
            throw new UserNotFoundException(sprintf('User with email "%s" not found.', $identifier));
        }

        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return in_array($class, [Student::class, Teacher::class, Employee::class], true);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new \InvalidArgumentException(sprintf('Instances of "%s" are not supported.', $class));
        }

        return $this->entityManager->getRepository($class)->find($user->getId());
    }
}