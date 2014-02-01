<?php

namespace Afup\BarometreBundle\Service\Reports;

use Doctrine\DBAL\Query\QueryBuilder;

class ResponseReports
{
    /**
     * @param QueryBuilder $query
     *
     * @return array
     */
    public function getSalaryReport(QueryBuilder $query)
    {
        $query->select('count(distinct response.id) as count');
        $query->addSelect('ROUND(grossAnnualSalary / 1000)  as salarySlice');
        $query->addGroupBy('salarySlice');

        $results = array();
        foreach ($query->execute() as $row) {
            $slice = $row['salarySlice'];
            $results[$slice] = array(
               'count' => $row['count']
            );
        }

        if (0 === count($results)) {
            return $results;
        }

        $baseResult = array(
          'count' => 0,
        );
        $min = min(array_keys($results));
        $max = max(array_keys($results));
        $baseResults = array_fill($min, $max - $min, $baseResult);

        $results = $results + $baseResults;
        ksort($results);

        foreach ($results as $key => &$result) {
            $result['salarySliceFrom'] = $key * 1000;
            $result['salarySliceTo'] = ($key + 1) * 1000;
        }

        return $results;
    }

    /**
     * @param QueryBuilder $query
     *
     * @return array
     */
    public function getCompanySizeReport(QueryBuilder $query)
    {
        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.companySize as companySize');
        $query->addGroupBy('response.companySize');

        return $query->execute();
    }

    /**
     * @param QueryBuilder $query
     *
     * @return array
     */
    public function getCompanyTypeReport(QueryBuilder $query)
    {
        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.companyType as companyType');
        $query->addGroupBy('response.companyType');

        return $query->execute();
    }

    /**
     * @param QueryBuilder $query
     *
     * @return array
     */
    public function getCompanyDepartmentReport(QueryBuilder $query)
    {
        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.companyDepartment as companyDepartment');
        $query->addGroupBy('response.companyDepartment');

        return $query->execute();
    }
}
