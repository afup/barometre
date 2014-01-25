<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="response")
 */
class Response
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     */
    protected $campaign;

    /**
     * @ORM\ManyToMany(targetEntity="Certification")
     */
    protected $certifiations;

    /**
     * @ORM\ManyToMany(targetEntity="Speciality")
     */
    protected $specialities;

    /**
     * @ORM\Column(type="integer")
     */
    protected $grossAnnualSalary;

    /**
     * @ORM\Column(type="integer")
     */
    protected $variableAnnualSalary;

    /**
     * @ORM\Column(type="integer")
     */
    protected $salarySatisfaction;

    /**
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * @ORM\Column(type="integer")
     */
    protected $initialTraining;

    /**
     * @ORM\Column(type="integer")
     */
    protected $compagnyType;

    /**
     * @ORM\Column(type="integer")
     */
    protected $compagnySize;

    /**
     * @ORM\Column(type="integer")
     */
    protected $compagnyDepartment;

    /**
     * @ORM\Column(type="integer")
     */
    protected $jobInterest;

    /**
     * @ORM\Column(type="integer")
     */
    protected $phpVersion;

    /**
     * @ORM\Column(type="integer")
     */
    protected $phpStrength;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $hasRecentTraining;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isRecentTrainingHadSalaryImpact;

    /**
     */
    public function __construct()
    {
        $this->certifications = new ArrayCollection();
        $this->specialities = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $grossAnnualSalary
     * @return Response
     */
    public function setGrossAnnualSalary($grossAnnualSalary)
    {
        $this->grossAnnualSalary = $grossAnnualSalary;

        return $this;
    }

    /**
     * @return integer
     */
    public function getGrossAnnualSalary()
    {
        return $this->grossAnnualSalary;
    }

    /**
     * @param integer $variableAnnualSalary
     * @return Response
     */
    public function setVariableAnnualSalary($variableAnnualSalary)
    {
        $this->variableAnnualSalary = $variableAnnualSalary;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVariableAnnualSalary()
    {
        return $this->variableAnnualSalary;
    }

    /**
     * @param integer $salarySatisfaction
     * @return Response
     */
    public function setSalarySatisfaction($salarySatisfaction)
    {
        $this->salarySatisfaction = $salarySatisfaction;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSalarySatisfaction()
    {
        return $this->salarySatisfaction;
    }

    /**
     * @param integer $status
     * @return Response
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $initialTraining
     * @return Response
     */
    public function setInitialTraining($initialTraining)
    {
        $this->initialTraining = $initialTraining;

        return $this;
    }

    /**
     * @return integer
     */
    public function getInitialTraining()
    {
        return $this->initialTraining;
    }

    /**
     * @param integer $compagnyType
     * @return Response
     */
    public function setCompagnyType($compagnyType)
    {
        $this->compagnyType = $compagnyType;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompagnyType()
    {
        return $this->compagnyType;
    }

    /**
     * @param integer $compagnySize
     * @return Response
     */
    public function setCompagnySize($compagnySize)
    {
        $this->compagnySize = $compagnySize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompagnySize()
    {
        return $this->compagnySize;
    }

    /**
     * @param integer $compagnyDepartment
     * @return Response
     */
    public function setCompagnyDepartment($compagnyDepartment)
    {
        $this->compagnyDepartment = $compagnyDepartment;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompagnyDepartment()
    {
        return $this->compagnyDepartment;
    }

    /**
     * @param integer $jobInterest
     * @return Response
     */
    public function setJobInterest($jobInterest)
    {
        $this->jobInterest = $jobInterest;

        return $this;
    }

    /**
     * @return integer
     */
    public function getJobInterest()
    {
        return $this->jobInterest;
    }

    /**
     * @param integer $phpVersion
     * @return Response
     */
    public function setPhpVersion($phpVersion)
    {
        $this->phpVersion = $phpVersion;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPhpVersion()
    {
        return $this->phpVersion;
    }

    /**
     * @param integer $phpStrength
     * @return Response
     */
    public function setPhpStrength($phpStrength)
    {
        $this->phpStrength = $phpStrength;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPhpStrength()
    {
        return $this->phpStrength;
    }

    /**
     * @param boolean $hasRecentTraining
     * @return Response
     */
    public function setHasRecentTraining($hasRecentTraining)
    {
        $this->hasRecentTraining = $hasRecentTraining;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasRecentTraining()
    {
        return $this->hasRecentTraining;
    }

    /**
     * @param boolean $isRecentTrainingHadSalaryImpact
     * @return Response
     */
    public function setIsRecentTrainingHadSalaryImpact($isRecentTrainingHadSalaryImpact)
    {
        $this->isRecentTrainingHadSalaryImpact = $isRecentTrainingHadSalaryImpact;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsRecentTrainingHadSalaryImpact()
    {
        return $this->isRecentTrainingHadSalaryImpact;
    }

    /**
     * @param \Afup\BarometreBundle\Entity\Campaign $campaign
     * @return Response
     */
    public function setCampaign(\Afup\BarometreBundle\Entity\Campaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * @return \Afup\BarometreBundle\Entity\Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param \Afup\BarometreBundle\Entity\Certification $certifiations
     * @return Response
     */
    public function addCertifiation(\Afup\BarometreBundle\Entity\Certification $certifiations)
    {
        $this->certifiations[] = $certifiations;

        return $this;
    }

    /**
     * @param \Afup\BarometreBundle\Entity\Certification $certifiations
     */
    public function removeCertifiation(\Afup\BarometreBundle\Entity\Certification $certifiations)
    {
        $this->certifiations->removeElement($certifiations);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertifiations()
    {
        return $this->certifiations;
    }

    /**
     * @param \Afup\BarometreBundle\Entity\Speciality $specialities
     * @return Response
     */
    public function addSpeciality(\Afup\BarometreBundle\Entity\Speciality $specialities)
    {
        $this->specialities[] = $specialities;

        return $this;
    }

    /**
     * @param \Afup\BarometreBundle\Entity\Speciality $specialities
     */
    public function removeSpeciality(\Afup\BarometreBundle\Entity\Speciality $specialities)
    {
        $this->specialities->removeElement($specialities);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialities()
    {
        return $this->specialities;
    }
}
