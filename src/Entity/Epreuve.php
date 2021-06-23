<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EpreuveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EpreuveRepository::class)
 */
class Epreuve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeModule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomModule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $classe;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreEleve;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sujet;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEpreuve;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="epreuves")
     */
    private $idUtilisateurs;

    /**
     * @ORM\OneToMany(targetEntity=Concerne::class, mappedBy="idEpreuve")
     */
    private $concernes;

    public function __construct()
    {
        $this->idUtilisateurs = new ArrayCollection();
        $this->concernes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeModule(): ?string
    {
        return $this->codeModule;
    }

    public function setCodeModule(string $codeModule): self
    {
        $this->codeModule = $codeModule;

        return $this;
    }

    public function getNomModule(): ?string
    {
        return $this->nomModule;
    }

    public function setNomModule(string $nomModule): self
    {
        $this->nomModule = $nomModule;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getNombreEleve(): ?int
    {
        return $this->nombreEleve;
    }

    public function setNombreEleve(int $nombreEleve): self
    {
        $this->nombreEleve = $nombreEleve;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateEpreuve(): ?\DateTimeInterface
    {
        return $this->dateEpreuve;
    }

    public function setDateEpreuve(\DateTimeInterface $dateEpreuve): self
    {
        $this->dateEpreuve = $dateEpreuve;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUtilisateurs(): Collection
    {
        return $this->idUtilisateurs;
    }

    public function addIdUtilisateur(User $idUtilisateur): self
    {
        if (!$this->idUtilisateurs->contains($idUtilisateur)) {
            $this->idUtilisateurs[] = $idUtilisateur;
        }

        return $this;
    }

    public function removeIdUtilisateur(User $idUtilisateur): self
    {
        $this->idUtilisateurs->removeElement($idUtilisateur);

        return $this;
    }

    /**
     * @return Collection|Concerne[]
     */
    public function getConcernes(): Collection
    {
        return $this->concernes;
    }

    public function addConcerne(Concerne $concerne): self
    {
        if (!$this->concernes->contains($concerne)) {
            $this->concernes[] = $concerne;
            $concerne->setIdEpreuve($this);
        }

        return $this;
    }

    public function removeConcerne(Concerne $concerne): self
    {
        if ($this->concernes->removeElement($concerne)) {
            // set the owning side to null (unless already changed)
            if ($concerne->getIdEpreuve() === $this) {
                $concerne->setIdEpreuve(null);
            }
        }

        return $this;
    }
}
