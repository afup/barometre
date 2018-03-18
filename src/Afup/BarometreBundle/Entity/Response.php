<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     *
     * @var int
     */
    protected $campaign;

    /**
     * @ORM\ManyToMany(targetEntity="Certification")
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $certifications;

    /**
     * @ORM\ManyToMany(targetEntity="Speciality")
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $specialities;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $grossAnnualSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $variableAnnualSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $annualSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $salarySatisfaction;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $initialTraining;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $jobTitle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $experience;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $companyType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $companySize;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     *
     * @var int
     */
    protected $companyDepartment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $jobInterest;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $otherLanguage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $phpVersion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $phpStrength;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $hasRecentTraining;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var bool
     */
    protected $isRecentTrainingHadSalaryImpact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $gender;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $osDeveloppment;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $technologicalWatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $remoteUsage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    protected $meetupParticipation;

    public function __construct()
    {
        $this->certifications = new ArrayCollection();
        $this->specialities = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $grossAnnualSalary
     *
     * @return Response
     */
    public function setGrossAnnualSalary($grossAnnualSalary)
    {
        $this->grossAnnualSalary = $grossAnnualSalary;

        return $this;
    }

    /**
     * @return int
     */
    public function getGrossAnnualSalary()
    {
        return $this->grossAnnualSalary;
    }

    /**
     * @param int $variableAnnualSalary
     *
     * @return Response
     */
    public function setVariableAnnualSalary($variableAnnualSalary)
    {
        $this->variableAnnualSalary = $variableAnnualSalary;

        return $this;
    }

    /**
     * @return int
     */
    public function getVariableAnnualSalary()
    {
        return $this->variableAnnualSalary;
    }

    /**
     * @param int $annualSalary
     *
     * @return Response
     */
    public function setAnnualSalary($annualSalary)
    {
        $this->annualSalary = $annualSalary;

        return $this;
    }

    /**
     * @return int
     */
    public function getAnnualSalary()
    {
        return $this->annualSalary;
    }

    /**
     * @param int $salarySatisfaction
     *
     * @return Response
     */
    public function setSalarySatisfaction($salarySatisfaction)
    {
        $this->salarySatisfaction = $salarySatisfaction;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalarySatisfaction()
    {
        return $this->salarySatisfaction;
    }

    /**
     * @param int $status
     *
     * @return Response
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $initialTraining
     *
     * @return Response
     */
    public function setInitialTraining($initialTraining)
    {
        $this->initialTraining = $initialTraining;

        return $this;
    }

    /**
     * @return int
     */
    public function getInitialTraining()
    {
        return $this->initialTraining;
    }

    /**
     * @param int $jobTitle
     *
     * @return Response
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return int
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param int $experience
     *
     * @return Response
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return int
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param int $companyType
     *
     * @return Response
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * @return int
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * @param int $companySize
     *
     * @return Response
     */
    public function setCompanySize($companySize)
    {
        $this->companySize = $companySize;

        return $this;
    }

    /**
     * @return int
     */
    public function getCompanySize()
    {
        return $this->companySize;
    }

    /**
     * @param int $companyDepartment
     *
     * @return Response
     */
    public function setCompanyDepartment($companyDepartment)
    {
        $this->companyDepartment = str_pad($companyDepartment, 2, '0', STR_PAD_LEFT);

        return $this;
    }

    /**
     * @return int
     */
    public function getCompanyDepartment()
    {
        return $this->companyDepartment;
    }

    /**
     * @param int $jobInterest
     *
     * @return Response
     */
    public function setJobInterest($jobInterest)
    {
        $this->jobInterest = $jobInterest;

        return $this;
    }

    /**
     * @return int
     */
    public function getJobInterest()
    {
        return $this->jobInterest;
    }

    /**
     * @param int $phpVersion
     *
     * @return Response
     */
    public function setPhpVersion($phpVersion)
    {
        $this->phpVersion = $phpVersion;

        return $this;
    }

    /**
     * @return int
     */
    public function getPhpVersion()
    {
        return $this->phpVersion;
    }

    /**
     * @param int $phpStrength
     *
     * @return Response
     */
    public function setPhpStrength($phpStrength)
    {
        $this->phpStrength = $phpStrength;

        return $this;
    }

    /**
     * @return int
     */
    public function getPhpStrength()
    {
        return $this->phpStrength;
    }

    /**
     * @param bool $hasRecentTraining
     *
     * @return Response
     */
    public function setHasRecentTraining($hasRecentTraining)
    {
        $this->hasRecentTraining = $hasRecentTraining;

        return $this;
    }

    /**
     * @return bool
     */
    public function getHasRecentTraining()
    {
        return $this->hasRecentTraining;
    }

    /**
     * @param bool $recentTrainingHadSalaryImpact
     *
     * @return Response
     */
    public function setRecentTrainingHadSalaryImpact($recentTrainingHadSalaryImpact)
    {
        $this->isRecentTrainingHadSalaryImpact = $recentTrainingHadSalaryImpact;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRecentTrainingHadSalaryImpact()
    {
        return $this->isRecentTrainingHadSalaryImpact;
    }

    /**
     * @param Campaign $campaign
     *
     * @return Response
     */
    public function setCampaign(Campaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param Certification $certifications
     *
     * @return Response
     */
    public function addCertification(Certification $certifications)
    {
        $this->certifications[] = $certifications;

        return $this;
    }

    /**
     * @param Certification $certifications
     */
    public function removeCertification(Certification $certifications)
    {
        $this->certifications->removeElement($certifications);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * @param Speciality $specialities
     *
     * @return Response
     */
    public function addSpeciality(Speciality $specialities)
    {
        $this->specialities[] = $specialities;

        return $this;
    }

    /**
     * @param Speciality $specialities
     */
    public function removeSpeciality(Speciality $specialities)
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

    /**
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     *
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return int
     */
    public function getTechnologicalWatch()
    {
        return $this->technologicalWatch;
    }

    /**
     * @param int $technologicalWatch
     *
     * @return $this
     */
    public function setTechnologicalWatch($technologicalWatch)
    {
        $this->technologicalWatch = $technologicalWatch;

        return $this;
    }

    /**
     * @return int
     */
    public function getOsDeveloppment()
    {
        return $this->osDeveloppment;
    }

    /**
     * @param int $osDeveloppment
     *
     * @return $this
     */
    public function setOsDeveloppment($osDeveloppment)
    {
        $this->osDeveloppment = $osDeveloppment;

        return $this;
    }

    /**
     * @return int
     */
    public function getOtherLanguage()
    {
        return $this->otherLanguage;
    }

    /**
     * @param int $otherLanguage
     *
     * @return $this
     */
    public function setOtherLanguage($otherLanguage)
    {
        $this->otherLanguage = $otherLanguage;

        return $this;
    }

    /**
     * @return int
     */
    public function getRemoteUsage()
    {
        return $this->remoteUsage;
    }

    /**
     * @param int $remoteUsage
     *
     * @return $this
     */
    public function setRemoteUsage($remoteUsage)
    {
        $this->remoteUsage = $remoteUsage;

        return $this;
    }

    /**
     * @return int
     */
    public function getMeetupParticipation()
    {
        return $this->meetupParticipation;
    }

    /**
     * @param int $meetupParticipation
     *
     * @return $this
     */
    public function setMeetupParticipation($meetupParticipation)
    {
        $this->meetupParticipation = $meetupParticipation;

        return $this;
    }
}
