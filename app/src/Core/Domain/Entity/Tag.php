<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use App\Core\Domain\Traits\EntityIdentifier;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 */
final class Tag
{
    use EntityIdentifier;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     */
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
