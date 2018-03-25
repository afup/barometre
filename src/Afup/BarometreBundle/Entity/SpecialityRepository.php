<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class SpecialityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

    /**
     * @param $name
     *
     * @return null|Speciality
     */
    public function findOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
