<?php

namespace Afup\BarometreBundle\Campaign\Tests\Units;

use atoum;
use Afup\BarometreBundle\Campaign\ResponseFactory as TestedClass;
use Afup\BarometreBundle\Enums\GenderEnums;
use Afup\BarometreBundle\Enums\StatusEnums;
use Afup\BarometreBundle\Enums\InitialTrainingEnums;
use Afup\BarometreBundle\Enums\CompanyTypeEnums;
use Afup\BarometreBundle\Enums\CompanySizeEnums;
use Afup\BarometreBundle\Enums\JobInterestEnums;
use Afup\BarometreBundle\Enums\PHPVersionEnums;
use Afup\BarometreBundle\Enums\PHPStrengthEnums;
use Afup\BarometreBundle\Enums\JobTitleEnums;
use Afup\BarometreBundle\Enums\ExperienceEnums;

class ResponseFactory extends atoum
{
    public function testCreateResponse()
    {
        $numberFormatter = new \NumberFormatter('fr', 1);
        $enumCollection = new \Afup\BarometreBundle\Enums\EnumsCollection();

        $enumCollection->addEnums(new StatusEnums(), 'status');
        $enumCollection->addEnums(new InitialTrainingEnums(), 'initial_training');
        $enumCollection->addEnums(new CompanyTypeEnums(), 'company_type');
        $enumCollection->addEnums(new CompanySizeEnums(), 'company_size');
        $enumCollection->addEnums(new JobInterestEnums(), 'job_interest');
        $enumCollection->addEnums(new PHPVersionEnums(), 'php_version');
        $enumCollection->addEnums(new PHPStrengthEnums(), 'php_strength');
        $enumCollection->addEnums(new JobTitleEnums(), 'job_title');
        $enumCollection->addEnums(new ExperienceEnums(), 'experience');
        $enumCollection->addEnums(new GenderEnums(), 'gender');


        $certificationRepository = new \mock\Doctrine\Common\Persistence\ObjectRepository();
        $specialityRepository = new \mock\Doctrine\Common\Persistence\ObjectRepository();

        $testedClass = new TestedClass(
            $numberFormatter,
            $enumCollection,
            $certificationRepository,
            $specialityRepository
        );

        $data = array (
            'gross_annual_salary' => '42 000',
            'variable_annual_salary' => '',
            'annual_salary' => '42 000',
            'salary_satisfaction' => '4',
            'status' => 'Contrat à durée indéterminée',
            'initial_training' => 'Niveau Master2  ou ingénieur',
            'company_type' => 'Agence de communication',
            'company_size' => 'De 50 à 199 salariés',
            'company_department' => '59',
            'job_interest' => 'La qualité de vie autour de votre emploi',
            'speciality' => 'Zend Framework',
            'php_version' => 'PHP 5.3',
            'has_certification' => 'Non',
            'certification_list' => '',
            'php_strength' => 'Son écosystème (outils, frameworks, documentation)',
            'email' => 'raoul@gmail.com',
            'has_formation' => '',
            'formation_subject' => '',
            'formation_impact' => '',
            'job_title' => '',
            'experience' => '',
            'gender' => '',
        );

        $campaign = new \Afup\BarometreBundle\Entity\Campaign();

        $this
            ->object($response = $testedClass->createResponse($data, $campaign))
              ->isInstanceof("Afup\BarometreBundle\Entity\Response")
              ->float($response->getGrossAnnualSalary())
                  ->isEqualTo((float)42000)
              ->integer($response->getStatus())
                  ->isEqualTo(StatusEnums::CDI)
              ->integer($response->getInitialTraining())
                  ->isEqualTo(InitialTrainingEnums::MASTER)
              ->integer($response->getCompanyType())
                  ->isEqualTo(CompanyTypeEnums::AGENCE_COMM)
              ->integer($response->getCompanySize())
                  ->isEqualTo(CompanySizeEnums::DE_50_A_199)
              ->integer($response->getJobInterest())
                  ->isEqualTo(JobInterestEnums::QUALITE_DE_VIE)
              ->integer($response->getPhpVersion())
                  ->isEqualTo(PHPVersionEnums::PHP_53)
              ->integer($response->getPhpStrength())
                  ->isEqualTo(PHPStrengthEnums::ECOSYSTEME)
        ;
    }
}
