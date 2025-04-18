<?php
// src/Entity/Teacher.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Teacher extends AbstractUser
{
    #[ORM\Column(type: 'boolean', length: 100)]
    private bool $isAdmin = false;

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
    // Add any teacher-specific properties if needed
}
