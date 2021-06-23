<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Concerne::class, mappedBy="idEleve")
     */
    private $concernes;

    public function __construct()
    {
        $this->concernes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

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
            $concerne->setIdEleve($this);
        }

        return $this;
    }

    public function removeConcerne(Concerne $concerne): self
    {
        if ($this->concernes->removeElement($concerne)) {
            // set the owning side to null (unless already changed)
            if ($concerne->getIdEleve() === $this) {
                $concerne->setIdEleve(null);
            }
        }

        return $this;
    }
}
