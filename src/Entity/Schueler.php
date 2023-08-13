<?php

namespace App\Entity;

use App\Repository\SchuelerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchuelerRepository::class)]
class Schueler
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255)]
    private ?string $Nachname = null;

    #[ORM\Column(length: 255)]
    private ?string $TelefonNummer = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $kommentar = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Vorname = null;

    #[ORM\ManyToOne(inversedBy: 'schuelers')]
    private ?Fachrichtung $fachrichtung = null;

    #[ORM\ManyToMany(targetEntity: Kurs::class, inversedBy: 'schuelers')]
    private Collection $kurse;

    public function __construct()
    {
        $this->kurse = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNachname(): ?string
    {
        return $this->Nachname;
    }

    public function setNachname(string $Nachname): static
    {
        $this->Nachname = $Nachname;

        return $this;
    }

    public function getTelefonNummer(): ?string
    {
        return $this->TelefonNummer;
    }

    public function setTelefonNummer(string $TelefonNummer): static
    {
        $this->TelefonNummer = $TelefonNummer;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getKommentar(): ?string
    {
        return $this->kommentar;
    }

    public function setKommentar(string $kommentar): static
    {
        $this->kommentar = $kommentar;

        return $this;
    }

    public function getVorname(): ?string
    {
        return $this->Vorname;
    }

    public function setVorname(?string $Vorname): static
    {
        $this->Vorname = $Vorname;

        return $this;
    }

    public function getFachrichtung(): ?Fachrichtung
    {
        return $this->fachrichtung;
    }

    public function setFachrichtung(?Fachrichtung $fachrichtung): static
    {
        $this->fachrichtung = $fachrichtung;

        return $this;
    }

    /**
     * @return Collection<int, Kurs>
     */
    public function getKurse(): Collection
    {
        return $this->kurse;
    }

    public function addKurse(Kurs $kurse): static
    {
        if (!$this->kurse->contains($kurse)) {
            $this->kurse->add($kurse);
        }

        return $this;
    }

    public function removeKurse(Kurs $kurse): static
    {
        $this->kurse->removeElement($kurse);

        return $this;
    }




}
