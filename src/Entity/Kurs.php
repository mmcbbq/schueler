<?php

namespace App\Entity;

use App\Repository\KursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: KursRepository::class)]
class Kurs
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $bezeichnung = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Schueler::class, mappedBy: 'kurse')]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $schueler->addKurse($this);
        }

        return $this;
    }

    public function removeSchueler(Schueler $schueler): static
    {
        if ($this->schuelers->removeElement($schueler)) {
            $schueler->removeKurse($this);
        }

        return $this;
    }
}
