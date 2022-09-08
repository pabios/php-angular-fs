<?php

namespace Pabiosoft\Entity;

use App\Repository\StyleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="style")
 */
class Style
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $titre = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $paragraphe = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $lien = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getParagraphe(): ?string
    {
        return $this->paragraphe;
    }

    public function setParagraphe(?string $paragraphe): self
    {
        $this->paragraphe = $paragraphe;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }
}
