<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\JobInterestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobInterestRepository::class)]
#[ORM\Table(name: 'job_interest')]
class JobInterest
{

    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    protected int $id;

    #[ORM\Column(type: 'string', length: 100)]
    protected string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
