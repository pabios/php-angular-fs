<?php

namespace Pabiosoft\Entity;


class Post
{
    private ?int $id = null;

    private ?string $title = null;

    private ?string $description = null;

    private ?string $imageUrl = null;

    private ?string $createdDate = null;

    private ?int $snaps = null;

    private ?string $location = null;

//    private ?User $user_id = null;

     private ?int $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getCreatedDate(): ?string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getSnaps(): ?int
    {
        return $this->snaps;
    }

    public function setSnaps(int $snaps): self
    {
        $this->snaps = $snaps;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId( $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
