<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Table(name="todo")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
final class Todo
{
    use IdentifierTrait;
    use TimestampTrait;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $closed = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $deleted = false;

    /**
     * @ORM\Column
     */
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    protected ?DateTimeImmutable $closedAt;

    private function __construct(string $todoTitle, ?string $description)
    {
        $this->id = Uuid::v4();
        $this->title = $todoTitle;
        $this->description = $description;
    }

    public static function create(string $title, ?string $description = null): self
    {
        return new self($title, $description);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function update(string $todoTitle, ?string $description)
    {
        $this->title = $todoTitle;
        $this->description = $description;
    }

    public function close(): void
    {
        $this->closed = true;
        $this->closedAt = new DateTimeImmutable();
    }

    public function reopen(): void
    {
        $this->closed = false;
        $this->closedAt = null;
    }

    public function delete(): void
    {
        $this->deleted = true;
        $this->deletedAt = new DateTimeImmutable();
    }

    public function recovery(): void
    {
        $this->deleted = false;
        $this->deletedAt = null;
    }
}
