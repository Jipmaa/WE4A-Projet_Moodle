<?php
// src/Entity/Employee.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'employee')]
class Employee extends AbstractUser
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $job;

    private const VALID_JOBS = [
        'Secrétaire',
        'Service gestion edt',
        'Directeur pôle',
        'Responsable service des études',
        'Directeur des systèmes d information',
        'Responsable service numérique et pédagogique',
    ];

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        if (!in_array($job, self::VALID_JOBS)) {
            throw new \InvalidArgumentException("Invalid job title");
        }

        $this->job = $job;
        return $this;
    }
}
