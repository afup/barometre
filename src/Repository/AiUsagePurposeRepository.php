<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AiUsagePurpose;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AiUsagePurposeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AiUsagePurpose::class);
    }
}
