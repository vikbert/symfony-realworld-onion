<?php

declare(strict_types = 1);

namespace App\Core\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

trait IdentifierTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected Uuid $id;
}
