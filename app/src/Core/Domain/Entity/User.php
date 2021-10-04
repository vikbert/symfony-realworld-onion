<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use App\Core\Domain\Traits\EntityIdentifier;
use App\Core\Domain\Traits\EntityTimestamp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 * @method string getUserIdentifier()
 */
final class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use EntityIdentifier;
    use EntityTimestamp;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min={8})
     */
    private string $password;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Length(min={3}, max={20})
     */
    private string $username;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $bio = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url
     */
    private ?string $image = null;

    /**
     * @var Collection|Article[]
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="author")
     */
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): void
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }
    }

    public function removeArticle(Article $article): void
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null);
            }
        }
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function __call($name, $arguments)
    {
    }
}
