<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Extrait = null;

    #[ORM\Column(length: 200)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?float $Rénumération = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateCréation = null;

    #[ORM\Column(length: 255)]
    private ?string $NumberPhone = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getExtrait(): ?string
    {
        return $this->Extrait;
    }

    public function setExtrait(string $Extrait): static
    {
        $this->Extrait = $Extrait;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getRénumération(): ?float
    {
        return $this->Rénumération;
    }

    public function setRénumération(float $Rénumération): static
    {
        $this->Rénumération = $Rénumération;

        return $this;
    }

    public function getDateCréation(): ?\DateTimeInterface
    {
        return $this->DateCréation;
    }

    public function setDateCréation(\DateTimeInterface $DateCréation): static
    {
        $this->DateCréation = $DateCréation;

        return $this;
    }

    public function getNumberPhone(): ?string
    {
        return $this->NumberPhone;
    }

    public function setNumberPhone(string $NumberPhone): static
    {
        $this->NumberPhone = $NumberPhone;

        return $this;
    }
}