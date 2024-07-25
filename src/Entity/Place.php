<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\Filter\CoordinateFilter;
use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['place']]
        ),
        new GetCollection(
            normalizationContext: ['groups' => ['places']],
        ),
    ],
)]
#[ApiResource(
    openapiContext: ['summary' => 'Retrieves the collection of Place resources by category.'],
    uriTemplate: '/categories/{categoryId}/places',
    uriVariables: ['categoryId' => new Link(fromClass: Category::class, toProperty: 'categories', description: 'Category identifier')],
    operations: [ new GetCollection(normalizationContext: ['groups' => ['places']]) ],
)]
#[ApiResource(
    openapiContext: ['summary' => 'Retrieves the collection of Place resources by century.'],
    uriTemplate: '/centuries/{centuryId}/places',
    uriVariables: ['centuryId' => new Link(fromClass: Century::class, toProperty: 'centuries', description: 'Century identifier')],
    operations: [ new GetCollection(normalizationContext: ['groups' => ['places']]) ],
)]
#[ApiResource(
    openapiContext: ['summary' => 'Retrieves the collection of Place resources by tag.'],
    uriTemplate: '/tags/{tagId}/places',
    uriVariables: ['tagId' => new Link(fromClass: Tag::class, toProperty: 'tags', description: 'Tag identifier')],
    operations: [ new GetCollection(normalizationContext: ['groups' => ['places']]) ],
)]
#[ApiFilter(BooleanFilter::class, properties: ['pictures.isMain'])]
#[ApiFilter(SearchFilter::class, properties: ['centuries.period'], strategy: 'exact')]
#[ApiFilter(CoordinateFilter::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    #[Groups(['place', 'places'])]
    private ?string $name = null;

    #[ORM\Column(length: 128, nullable: true)]
    #[Groups(['place', 'places'])]
    private ?string $subtitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('place')]
    private ?string $address = null;

    #[ORM\Column(length: 64)]
    #[Groups('place')]
    private ?string $postcode = null;

    #[ORM\Column(length: 64)]
    #[Groups('place')]
    private ?string $city = null;

    #[ORM\Column(length: 64)]
    #[Groups('place')]
    private ?string $country = null;

    #[ORM\Column(length: 64, nullable: true)]
    #[Groups('place')]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups('place')]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('place')]
    private ?string $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('place')]
    private ?string $opening_hours = null;

    #[ORM\Column(nullable: true)]
    #[Groups('place')]
    private ?float $rating = null;

    #[ORM\Column(nullable: true)]
    #[Groups('place')]
    private ?bool $accessibility = null;

    #[ORM\Column(nullable: true)]
    #[Groups('place')]
    private ?bool $guidedTour = null;

    #[ORM\Column]
    #[Groups(['place', 'places'])]
    private ?bool $isValid = null;

    #[ORM\Column]
    #[Groups('place')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups('place')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 128)]
    #[Groups(['place', 'places'])]
    private ?string $slug = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'places')]
    #[Groups(['place', 'places'])]
    private Collection $categories;

    /**
     * @var Collection<int, Century>
     */
    #[ORM\ManyToMany(targetEntity: Century::class, inversedBy: 'places')]
    #[Groups('place')]
    private Collection $centuries;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'places')]
    #[Groups('place')]
    private Collection $tags;

    /**
     * @var Collection<int, Picture>
     */
    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'place')]
    #[Groups(['place', 'places'])]
    private Collection $pictures;

    #[ORM\Column]
    #[Groups('place')]
    private ?float $latitude = null;

    #[ORM\Column]
    #[Groups('place')]
    private ?float $longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('place')]
    private ?string $website = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->centuries = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOpeningHours(): ?string
    {
        return $this->opening_hours;
    }

    public function setOpeningHours(?string $opening_hours): static
    {
        $this->opening_hours = $opening_hours;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function isAccessibility(): ?bool
    {
        return $this->accessibility;
    }

    public function setAccessibility(?bool $accessibility): static
    {
        $this->accessibility = $accessibility;

        return $this;
    }

    public function isGuidedTour(): ?bool
    {
        return $this->guidedTour;
    }

    public function setGuidedTour(?bool $guidedTour): static
    {
        $this->guidedTour = $guidedTour;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): static
    {
        $this->isValid = $isValid;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Century>
     */
    public function getCenturies(): Collection
    {
        return $this->centuries;
    }

    public function addCentury(Century $century): static
    {
        if (!$this->centuries->contains($century)) {
            $this->centuries->add($century);
        }

        return $this;
    }

    public function removeCentury(Century $century): static
    {
        $this->centuries->removeElement($century);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setPlace($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getPlace() === $this) {
                $picture->setPlace(null);
            }
        }

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }
}
