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

        $this->data = $this->addPercentResponse($this->data);
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
     * @param array $data
     *
     * @return array
     */
    protected function groupDataByRegion(array $data)
    {
        $preparedData = array();
        $codesRegionsByCodesDepartment = $this->getCodesRegionsByCodeDepartement();

        foreach ($data as $row) {
            if (!isset($codesRegionsByCodesDepartment[$row['companyDepartment']])) {
                continue;
            }
            $codeRegion = $codesRegionsByCodesDepartment[$row['companyDepartment']];
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
