<?php

namespace App\Entity;

use App\Repository\SchuelerRepository;
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

}
