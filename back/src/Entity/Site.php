<?php

namespace Pabiosoft\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="site")
 */
class Site
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
    private ?string $name = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $logo = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $misAjour = null;

    /**
     * @ORM\Column(type="string")
     */

    private ?string $proprietaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getMisAjour(): ?string
    {
        return $this->misAjour;
    }

    public function setMisAjour(?string $misAjour): self
    {
        $this->misAjour = $misAjour;

        return $this;
    }
}
