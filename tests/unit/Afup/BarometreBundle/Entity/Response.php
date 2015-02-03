<?php

namespace Afup\BarometreBundle\Entity\Tests\Units;

use agallou\Departements\Collection;
use atoum;


class Response extends atoum
{
    public function testSetCompanyDepartmentCorrectInput()
    {
        $department = new Collection();
        $department_array = $department->getAll();
        //Seules les valeurs de 1 à 9 sont réellement problématique, mais ça ne coute pas plus cher
        for ($i = 1; $i<20; ++$i) {
            $response = new \Afup\BarometreBundle\Entity\Response();
            $response->setCompanyDepartment($i);
            $this
                ->boolean(array_key_exists($response->getCompanyDepartment(), $department_array))
                    ->isTrue();
        }
    }

}
