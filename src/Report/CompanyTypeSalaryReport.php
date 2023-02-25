<?php

declare(strict_types=1);

namespace App\Report;

class CompanyTypeSalaryReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $results = $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.companyType as companyType')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.experience, response.companyType')
            ->fetchAllAssociative();

        $data = [
            'columns' => [],
            'data' => [],
        ];

        foreach ($results as $result) {
            if (!\array_key_exists($result['experience'], $data['data'])) {
                $data['data'][$result['experience']] = [];
            }

            if (!\in_array($result['companyType'], $data['columns'], true)) {
                $data['columns'][] = $result['companyType'];
            }

            $data['data'][$result['experience']][$result['companyType']] = $result;
        }

        $this->data = $data;
    }

    /**
     * The report name (used for url).
     *
     * @return string
     */
    public function getName()
    {
        return 'company_type_salary';
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        $data = $this->getData();

        return \count($data['data']);
    }
}
