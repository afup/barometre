<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use agallou\Departements\Collection;
use App\Entity\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testSetCompanyDepartmentCorrectInput(): void
    {
        $department = new Collection();
        $departmentArray = $department->getAll();

        for ($i = 1; $i < 20; ++$i) {
            $response = new Response();
            $department = mb_str_pad((string) $i, 2, '0', \STR_PAD_LEFT);
            $response->setCompanyDepartment($department);

            $this->assertArrayHasKey(
                $response->getCompanyDepartment(),
                $departmentArray,
                \sprintf('Department %s should be valid', $department)
            );
        }
    }
}
