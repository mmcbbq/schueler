<?php

namespace App\Entity;

use App\Repository\SchuelerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchuelerRepository::class)]
class Schueler
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $vorname = null;

    #[ORM\Column(length: 255)]
    private ?string $nachname = null;

    #[ORM\Column(length: 255)]
    private ?string $telefonnummer = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $kommentar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVorname(): ?string
    {
        return $this->vorname;
    }

    public function setVorname(string $vorname): static
    {
        $this->vorname = $vorname;

        return $this;
    }

    public function getNachname(): ?string
    {
        return $this->nachname;
    }

    public function setNachname(string $nachname): static
    {
        $this->nachname = $nachname;

        return $this;
    }

    public function getTelefonnummer(): ?string
    {
        return $this->telefonnummer;
    }

    public function setTelefonnummer(string $telefonnummer): static
    {
        $this->telefonnummer = $telefonnummer;

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
}
