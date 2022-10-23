<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
class Planet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(unique: true)]
    #[Assert\Unique]
    #[Assert\NotNull]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $rotation_period = null;

    #[ORM\Column(nullable: true)]
    private ?int $orbital_period = null;

    #[ORM\Column(nullable: true)]
    private ?int $diameter = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRotationPeriod(): ?int
    {
        return $this->rotation_period;
    }

    /**
     * @param int|null $rotation_period
     * @return $this
     */
    public function setRotationPeriod(?int $rotation_period): self
    {
        $this->rotation_period = $rotation_period;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrbitalPeriod(): ?int
    {
        return $this->orbital_period;
    }

    /**
     * @param int|null $orbital_period
     * @return $this
     */
    public function setOrbitalPeriod(?int $orbital_period): self
    {
        $this->orbital_period = $orbital_period;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    /**
     * @param int|null $diameter
     * @return $this
     */
    public function setDiameter(?int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array(
            'id' => $this->id,
            'name'=> $this->name,
            'rotation_period'=> $this->rotation_period,
            'orbital_period'=> $this->orbital_period,
            'diameter'=> $this->diameter,
        );
    }
}
