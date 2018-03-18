<?php

namespace Afup\Barometre\Report;

class CompanySizeSalaryReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $results = $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.companySize as companySize')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter(':minResult', $this->minResult)
            ->groupBy('response.experience, response.companySize')
            ->execute();

        $data = [
            'columns' => [],
            'data' => [],
        ];

        foreach ($results as $result) {
            if (!array_key_exists($result['experience'], $data['data'])) {
                $data['data'][$result['experience']] = [];
            }

            if (!in_array($result['companySize'], $data['columns'])) {
                $data['columns'][] = $result['companySize'];
            }

            $data['data'][$result['experience']][$result['companySize']] = $result;
        }

        $this->data = $data;
    }

    /**
     * The report name (used for url)
     *
     * @return string
     */
    public function getName()
    {
        return 'company_size_salary';
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        $data = $this->getData();

        return count($data['data']);
    }
}
