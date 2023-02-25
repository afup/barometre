<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampaignRepository::class)]
#[ORM\Table(name: 'campaign')]
class Campaign
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\Column(type: 'string', length: 100)]
    protected string $name;

    #[ORM\Column(type: 'date')]
    protected \DateTime $startDate;

    #[ORM\Column(type: 'date')]
    protected \DateTime $endDate;

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

    public function setStartDate(\DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setEndDate(\DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function __toString()
    {
        return $this->name;
    }
}
