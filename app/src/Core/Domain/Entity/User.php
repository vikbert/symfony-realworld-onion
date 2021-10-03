<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use App\Core\Domain\Traits\EntityIdentifier;
use App\Core\Domain\Traits\EntityTimestamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 */
final class User
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
}
