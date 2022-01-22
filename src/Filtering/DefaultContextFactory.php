<?php

declare(strict_types=1);

namespace App\Filtering;

use App\Repository\CampaignRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class DefaultContextFactory extends ContextFactory
{
    protected CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @return Context
     */
    public function createFromRequestStack(RequestStack $requestStack)
    {
        $context = parent::createFromRequestStack($requestStack);

        if (0 === \count($context->getParameters())) {
            $lastCampaign = $this->campaignRepository->findLast();
            if (null !== $lastCampaign) {
                $context->setParameter('campaign', [$lastCampaign->getId()]);
            }
        }

        return $context;
    }
}
