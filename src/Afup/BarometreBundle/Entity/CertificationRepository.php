<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CertificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Certification::class);
    }

    /**
     * @param $name
     *
     * @return null|Certification
     */
    public function findOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
