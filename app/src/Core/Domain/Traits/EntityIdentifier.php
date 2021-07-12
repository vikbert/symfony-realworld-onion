<?php

declare(strict_types = 1);

namespace App\Core\Domain\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

trait EntityIdentifier
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected Uuid $id;

    public function getId(): Uuid
    {
        return $this->id;
    }
}
