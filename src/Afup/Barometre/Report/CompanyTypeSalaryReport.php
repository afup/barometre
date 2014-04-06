<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;

class CompanyTypeSalaryReport implements ReportInterface
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * {@inheritdoc}
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Process the query
     *
     * @return array
     */
    public function getData()
    {
        $results =  $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.companyType as companyType')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= 10')
            ->groupBy('response.experience, response.companyType')
            ->execute();

        $data = [
            'columns' => [],
            'data'    => []
        ];

        foreach ($results as $result) {
            if (!array_key_exists($result['experience'], $data['data'])) {
                $data['data'][$result['experience']] = array();
            }

            if (!in_array($result['companyType'], $data['columns'])) {
                $data['columns'][] = $result['companyType'];
            }

            $data['data'][$result['experience']][$result['companyType']] = $result;
        }

        return $data;
    }

    /**
     * The report name (used for url)
     *
     * @return string
     */
    public function getName()
    {
        return 'company_type_salary';
    }

    /**
     * The report label (used for title & menu)
     *
     * @return string
     */
    public function getLabel()
    {
        return "report.company_type_salary.label";
    }
}
