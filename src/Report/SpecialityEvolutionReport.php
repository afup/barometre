<?php

declare(strict_types=1);

namespace App\Report;

use App\RequestModifier\RequestModifierCollection;
use Symfony\Component\HttpFoundation\Request;

class SpecialityEvolutionReport extends AbstractReport implements AlterableReportInterface
{
    /**
     * @param int $minResult
     */
    public function __construct(private readonly RequestModifierCollection $requestModifierCollection, $minResult = 10)
    {
        parent::__construct($minResult);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('speciality.name as specialityName')
            ->addSelect('campaign.name')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->add('where', 'speciality.name is not null')
            ->join(
                'response',
                'response_speciality',
                'response_speciality',
                'response.id = response_speciality.response_id'
            )
            ->join(
                'response_speciality',
                'speciality',
                'speciality',
                'response_speciality.speciality_id = speciality.id'
            )
            ->join('response', 'campaign', 'campaign', 'response.campaign_id = campaign.id')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.campaign_id')
            ->addGroupBy('specialityName')
            ->addOrderBy('campaign.name')
            ->addOrderBy('specialityName', 'asc')
        ;

        // top 5 technos
        $framework = [
            'Symfony',
            'Laravel',
            'Wordpress',
            'Drupal',
            'Laminas',
        ];

        $laminas = [
            'Zend Framework',
            'Laminas (ex Zend Framework)',
        ];

        $otherFramework = 'Autre';

        $columns = array_merge($framework, [$otherFramework]);
        sort($columns);

        $data = [];

        foreach ($this->queryBuilder->fetchAllAssociative() as $row) {
            $specialityName = $otherFramework;

            if (\in_array($row['specialityName'], $framework, true)) {
                $specialityName = $row['specialityName'];
            }

            if (\in_array($row['specialityName'], $laminas, true)) {
                $specialityName = 'Laminas';
            }

            if (!isset($data[$row['name']][$specialityName])) {
                $data[$row['name']][$specialityName] = 0;
            }

            $data[$row['name']][$specialityName] += $row['nbResponse'];
        }

        foreach ($data as $campaignId => $values) {
            $data[$campaignId] = $values + array_fill_keys($columns, 0);
            ksort($data[$campaignId]);
        }

        if (\count($data)) {
            $this->data = [
                'data' => $data,
                'columns' => $columns,
            ];
        }
    }

    public function alterRequest(Request $request)
    {
        $this->requestModifierCollection->getModifier('filter_on_all_campaigns')->alterRequest($request);
    }

    public function getName()
    {
        return 'speciality_evolution';
    }
}
