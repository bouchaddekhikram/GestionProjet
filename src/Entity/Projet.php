<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProjet = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Tache::class)]
    private Collection $tache;

    public function __construct()
    {
        $this->tache = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNomProjet(): ?string
    {
        return $this->nomProjet;
    }

    public function setNomProjet(string $nomProjet): static
    {
        $this->nomProjet = $nomProjet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTache(): Collection
    {
        return $this->tache;
    }

    public function addTache(Tache $tache): static
    {
        if (!$this->tache->contains($tache)) {
            $this->tache->add($tache);
            $tache->setProjet($this);
        }

        return $this;
    }

    public function removeTache(Tache $tache): static
    {
        if ($this->tache->removeElement($tache)) {
            // set the owning side to null (unless already changed)
            if ($tache->getProjet() === $this) {
                $tache->setProjet(null);
            }
        }

        return $this;
    }
}
