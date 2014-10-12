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
        return $this->findOneBy(array(), array('endDate' => 'desc'));
    }
}
