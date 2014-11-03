<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CampaignRepository extends EntityRepository
{
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
