<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use App\Core\Domain\Traits\EntityIdentifier;
use App\Core\Domain\Traits\EntityTimestamp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 */
final class Article
{
    use EntityTimestamp;
    use EntityIdentifier;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private string $body;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"title"}, updatable=true, unique=true)
     * @Assert\Blank
     */
    private string $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private string $description;

    /**
     * @var Collection|Tag[]
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="articles")
     */
    private Collection $tags;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    public function __construct(UserInterface $author)
    {
        $this->tags = new ArrayCollection();
        $this->author = $author;
    }

    public function __toString(): string
    {
        return $this->title;
    }

    //@info: getter will be used by annotation @Assert
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }
}
