<?php

namespace App\Entity;

use App\Repository\FachrichtungRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FachrichtungRepository::class)]
class Fachrichtung
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $bezeichnung = null;

    #[ORM\OneToMany(mappedBy: 'fachrichtung', targetEntity: Schueler::class)]
    private Collection $schuelers;

    public function __construct()
    {
        $this->schuelers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBezeichnung(): ?string
    {
        return $this->bezeichnung;
    }

    public function setBezeichnung(string $bezeichnung): static
    {
        $this->bezeichnung = $bezeichnung;

        return $this;
    }

    /**
     * @return Collection<int, Schueler>
     */
    public function getSchuelers(): Collection
    {
        return $this->schuelers;
    }

    public function addSchueler(Schueler $schueler): static
    {
        if (!$this->schuelers->contains($schueler)) {
            $this->schuelers->add($schueler);
            $schueler->setFachrichtung($this);
        }

        return $this;
    }

    public function removeSchueler(Schueler $schueler): static
    {
        if ($this->schuelers->removeElement($schueler)) {
            // set the owning side to null (unless already changed)
            if ($schueler->getFachrichtung() === $this) {
                $schueler->setFachrichtung(null);
            }
        }

        return $this;
    }
}
