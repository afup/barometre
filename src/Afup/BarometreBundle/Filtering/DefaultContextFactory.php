<?php

namespace Afup\BarometreBundle\Filtering;

use Afup\BarometreBundle\Entity\CampaignRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class DefaultContextFactory extends ContextFactory
{
    /**
     * @var CampaignRepository
     */
    protected $campaignRepository;

    /**
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return Context
     */
    public function createFromRequestStack(RequestStack $requestStack)
    {
        $context = parent::createFromRequestStack($requestStack);

        if (0 === count($context->getParameters())) {
            $lastCampaign = $this->campaignRepository->findLast();
            if (null !== $lastCampaign) {
                $context->setParameter('campaign', [$lastCampaign->getId()]);
            }
        }

        return $context;
    }
}
