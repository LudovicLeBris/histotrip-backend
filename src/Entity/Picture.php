<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    #[Groups(['place', 'places'])]
    private ?string $name = null;

    #[ORM\Column(length: 128)]
    #[Groups('place')]
    private ?string $pictureLegend = null;

    #[ORM\Column(length: 255)]
    #[Groups(['place', 'places'])]
    private ?string $cdnUrl = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Groups(['place', 'places'])]
    private ?bool $isMain = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?Place $place = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPictureLegend(): ?string
    {
        return $this->pictureLegend;
    }

    public function setPictureLegend(string $pictureLegend): static
    {
        $this->pictureLegend = $pictureLegend;

        return $this;
    }

    public function getCdnUrl(): ?string
    {
        return $this->cdnUrl;
    }

    public function setCdnUrl(string $cdnUrl): static
    {
        $this->cdnUrl = $cdnUrl;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getIsMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): static
    {
        $this->isMain = $isMain;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): static
    {
        $this->place = $place;

        return $this;
    }
}
