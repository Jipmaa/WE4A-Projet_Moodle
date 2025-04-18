<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'student')]
class Student extends AbstractUser
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $department;

    private const VALID_DEPARTMENTS = [
        'Common core',
        'Energy',
        'Computer science',
        'EDIM',
        'IMSI',
        'GMC',
    ];

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        if (!in_array($department, self::VALID_DEPARTMENTS)) {
            throw new \InvalidArgumentException("Invalid department title");
        }

        $this->department = $department;
        return $this;
    }
}
