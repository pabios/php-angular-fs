<?php

namespace Pabiosoft\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pabiosoft\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="message")
 */
class Message
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
    private ?string $content = null;

//    #[ORM\Column(type: Types::DATE_MUTABLE)]
    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $laDate = null;

//    /**
//     * @ORM\ManyToOne(targetEntity=User::class)
//     */
//    private ?User $user = null;

    /**
     * @ORM\Column(type="string")
     */
     private $user = null;



    public function  __construct(){
        $this->laDate = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getLaDate(): ?\DateTimeInterface
    {
        return $this->laDate;
    }

    public function setLaDate(\DateTimeInterface $laDate): self
    {
        $this->laDate = $laDate;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser( $user): self
    {
        $this->user = $user;

        return $this;
    }
}
