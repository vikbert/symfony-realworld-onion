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
final class Comment
{
    use EntityIdentifier;
    use EntityTimestamp;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private string $body;

    public function getBody(): string
    {
        return $this->body;
    }

    public function __toString(): string
    {
        return $this->body;
    }
}
