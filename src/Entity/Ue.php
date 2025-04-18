<?php
// src/Entity/Ue.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'ue')]
class Ue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $id_responsable;

    #[ORM\Column(type: 'integer')]
    private int $capacity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    private const VALID_UE_TYPES = [
        'CS',
        'TM',
        'OM',
        'QC',
        'EC',
    ];

    // Getter and Setter for $id
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter and Setter for $id_responsable
    public function getIdResponsable(): int
    {
        return $this->id_responsable;
    }

    public function setIdResponsable(int $id_responsable): self
    {
        $this->id_responsable = $id_responsable;
        return $this;
    }

    // Getter and Setter for $capacity
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
    }

    // Getter and Setter for $name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    // Getter and Setter for $type
    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        if (!in_array($type, self::VALID_UE_TYPES)) {
            throw new \InvalidArgumentException("Invalid UE type");
        }

        $this->type = $type;
        return $this;
    }
}
