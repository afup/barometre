<?php

namespace Afup\Barometre\Report;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;

class CompanySizeSalaryReport implements ReportInterface
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
            ->addSelect('response.companySize as companySize')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->groupBy('response.experience, response.companySize')
            ->execute();

        $data = [
            'columns' => [],
            'data'    => []
        ];

        foreach ($results as $result) {
            if (!array_key_exists($result['experience'], $data['data'])) {
                $data['data'][$result['experience']] = array();
            }

            if (!in_array($result['companySize'], $data['columns'])) {
                $data['columns'][] = $result['companySize'];
            }

            $data['data'][$result['experience']][$result['companySize']] = $result;
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
        return 'company_size_salary';
    }

    /**
     * The report label (used for title & menu)
     *
     * @return string
     */
    public function getLabel()
    {
        return "report.company_size_salary.label";
    }
}
