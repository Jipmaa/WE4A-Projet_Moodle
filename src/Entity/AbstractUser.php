<?php
// src/Entity/AbstractUser.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\ORM\Mapping\MappedSuperclass;
use App\Repository\AbstractUserRepository;



#[ORM\MappedSuperclass]
abstract class AbstractUser implements UserInterface, PasswordAuthenticatedUserInterface

{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 100)]
    private string $surname;

    #[ORM\Column(length: 100, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', length: 100)]
    private string $phone_number;

    #[ORM\Column(type: 'string', length: 100)]
    private string $password;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    public function getRoles(): array
    {
        $roles = $this->roles;

        // Garantir qu'au moins ROLE_USER est toujours présent
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }


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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    // Implementing the UserInterface methods

    public function getSalt(): ?string
    {
        return null; // Not needed with bcrypt or argon2i
    }


    public function eraseCredentials(): void
    {
        // You can leave this empty if you're not using sensitive data.
        // For example, if you store passwords in plaintext (you shouldn't), clear them here.
    }

    /**
     * This method is used by Symfony to identify users by their username.
     * It's usually the email address or username.
     */
    public function getUserIdentifier(): string
    {
        return $this->email; // Assuming email is used as the identifier
    }
}
