<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Repository;

use Afup\BarometreBundle\Entity\HostingType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class HostingTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HostingType::class);
    }
}
