<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Repository;

use Afup\BarometreBundle\Entity\Campaign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\OptimisticLockException;

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

    /**
     * @param $name
     *
     * @throws DBALException
     * @throws OptimisticLockException
     */
    public function removeCampaign($name)
    {
        $campaign = $this->findOneBy(['name' => $name]);

        if (!$campaign instanceof Campaign) {
            return;
        }

        $deleteResponseSQL = 'DELETE FROM response WHERE campaign_id = :id';

        $connection = $this->getEntityManager()->getConnection();

        $connection->executeUpdate(
            $deleteResponseSQL,
            ['id' => $campaign->getId()]
        );

        $this->getEntityManager()->remove($campaign);
        $this->getEntityManager()->flush();
    }
}
