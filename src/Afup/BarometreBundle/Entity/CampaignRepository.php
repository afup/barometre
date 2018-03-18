<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CampaignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campaign::class);
    }

    /**
     * @return Campaign|null
     */
    public function findLast()
    {
        return $this->findOneBy([], ['endDate' => 'desc']);
    }

    /**
     * @return array
     */
    public function findAllOrderedByDate()
    {
        return $this->createQueryBuilder('campaign')
            ->addOrderBy('campaign.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
