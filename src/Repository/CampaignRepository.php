<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Campaign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

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
     * @throws Exception
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

        $connection->executeStatement(
            $deleteResponseSQL,
            ['id' => $campaign->getId()]
        );

        $this->getEntityManager()->remove($campaign);
        $this->getEntityManager()->flush();
    }
}
