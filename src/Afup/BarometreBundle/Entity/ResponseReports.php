<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\DBAL\Query\QueryBuilder;

class ResponseReports
{

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

    public function getCompanySizeReport(QueryBuilder $query)
    {
        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.compagnySize as companySize');
        $query->addGroupBy('response.compagnySize');

        return $query->execute();
    }

    public function getCompanyTypeReport(QueryBuilder $query)
    {
        $query->select('count(distinct response.id) as count');
        $query->addSelect('response.compagnyType as companyType');
        $query->addGroupBy('response.compagnyType');

        return $query->execute();
    }

}
