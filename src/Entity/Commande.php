<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $UserCommande = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'commandes')]
    private Collection $commandePanier;

    public function __construct()
    {
        $this->commandePanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getUserCommande(): ?User
    {
        return $this->UserCommande;
    }

    public function setUserCommande(?User $UserCommande): static
    {
        $this->UserCommande = $UserCommande;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getCommandePanier(): Collection
    {
        return $this->commandePanier;
    }

    public function addCommandePanier(Produit $commandePanier): static
    {
        if (!$this->commandePanier->contains($commandePanier)) {
            $this->commandePanier->add($commandePanier);
        }

        return $this;
    }

    public function removeCommandePanier(Produit $commandePanier): static
    {
        $this->commandePanier->removeElement($commandePanier);

        return $this;
    }
}
