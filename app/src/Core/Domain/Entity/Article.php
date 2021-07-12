<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use App\Core\Domain\Traits\EntityIdentifier;
use App\Core\Domain\Traits\EntityTimestamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Gedmo\Mapping\Annotation as Gedmo;
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
}
