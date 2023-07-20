<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\Range(
        min: 5,
        max: 500,
        notInRangeMessage: 'La rénumération doit être comprise entre {{ min }} et {{ max }} €',
    )]
    private ?float $Renumeration = null;

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

    public function getRenumeration(): ?float
    {
        return $this->Renumeration;
    }

    public function setRenumeration(float $Renumeration): static
    {
        $this->Renumeration = $Renumeration;

        return $this;
    }
}
