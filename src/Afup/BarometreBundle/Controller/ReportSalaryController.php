<?php

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportSalaryController extends Controller
{
    public function indexAction()
    {
        $query = $this->get('afup.barometre.query_builder_factory')->getResponse();

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

        return $this->render('AfupBarometreBundle:Report:salary.html.twig', array(
          'results' => $results,
        ));
    }
}
