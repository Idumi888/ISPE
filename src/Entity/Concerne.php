<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ConcerneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ConcerneRepository::class)
 */
class Concerne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="boolean")
     */
    private $presence;

    /**
     * @ORM\ManyToOne(targetEntity=Epreuve::class, inversedBy="concernes")
     */
    private $idEpreuve;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="concernes")
     */
    private $idEleve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getPresence(): ?bool
    {
        return $this->presence;
    }

    public function setPresence(bool $presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    public function getIdEpreuve(): ?Epreuve
    {
        return $this->idEpreuve;
    }

    public function setIdEpreuve(?Epreuve $idEpreuve): self
    {
        $this->idEpreuve = $idEpreuve;

        return $this;
    }

    public function getIdEleve(): ?Eleve
    {
        return $this->idEleve;
    }

    public function setIdEleve(?Eleve $idEleve): self
    {
        $this->idEleve = $idEleve;

        return $this;
    }
}
