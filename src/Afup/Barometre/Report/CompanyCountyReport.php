<?php

namespace Afup\Barometre\Report;

use agallou\Regions\Collection2016 as Collection;
use agallou\Regions\Region;

class CompanyCountyReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $data = $this->queryBuilder
            ->select('response.companyDepartment as companyDepartment')
            ->addSelect('response.annualSalary as annualSalary')
            ->execute()
            ->fetchAll()
        ;

        $preparedData = $this->groupDataByRegion($data);

        $this->data = array();
        foreach ($preparedData as $codeRegion => $row) {
            if ($row['nbResponse'] < $this->minResult) {
                continue;
            }
            $row['companyDepartment'] = $codeRegion;
            $row['annualSalary'] = $row['totalAnnualSalary'] / $row['nbResponse'];
            unset($row['totalAnnualSalary']);
            $this->data[] = $row;
        }
    }

    /**
     * @return array
     */
    protected function getCodesRegionsByCodeDepartement()
    {
        $codesRegionsByCodesDeparatement = array();

        $regions = new Collection();
        /** @var Region $region */
        foreach ($regions as $region) {
            foreach ($region->getCodesDepartements() as $codesDepartement) {
                $codesRegionsByCodesDeparatement[$codesDepartement] = $region->getCode();
            }
        }

        return $codesRegionsByCodesDeparatement;
    }

    /**
     * @param arrya $data
     *
     * @return array
     */
    protected function groupDataByRegion(array $data)
    {
        $preparedData = array();
        $codesRegionsByCodesDeparatement = $this->getCodesRegionsByCodeDepartement();

        foreach ($data as $row) {
            if (!isset($codesRegionsByCodesDeparatement[$row['companyDepartment']])) {
                continue;
            }
            $codeRegion = $codesRegionsByCodesDeparatement[$row['companyDepartment']];
            if (!isset($preparedData[$codeRegion])) {
                $preparedData[$codeRegion] = array(
                    'nbResponse' => 0,
                    'totalAnnualSalary' => 0,
                );
            }
            $preparedData[$codeRegion]['nbResponse']++;
            $preparedData[$codeRegion]['totalAnnualSalary'] += $row['annualSalary'];
        }

        return $preparedData;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_county';
    }


    /**
     * report weight
     *
     * @return int
     */
    public function getWeight()
    {
        return null;
    }
}
