<?php

namespace Afup\BarometreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     *
     * @var Campaign
     */
    private $campaign;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $grossAnnualSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $variableAnnualSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $annualSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $salarySatisfaction;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $initialTraining;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $jobTitle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $experience;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $freelanceTjm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $freelanceAverageWorkDayPerYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $contractWorkDuration;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     *
     * @var int
     */
    private $companyDepartment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $companyType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $companySize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $jobInterest;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $companyOrigin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $otherLanguage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $remoteUsage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $meetupParticipation;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $technologicalWatch;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $osDeveloppment;

    /**
     * @ORM\ManyToMany(targetEntity="HostingType")
     *
     * @var Collection
     */
    private $hostingTypes;

    /**
     * @ORM\ManyToMany(targetEntity="ContainerEnvironmentUsage")
     *
     * @var Collection
     */
    private $containerEnvironmentsUsage;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $workMethod;

    /**
     * @ORM\ManyToMany(targetEntity="Speciality")
     *
     * @var Collection
     */
    private $specialities;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $phpVersion;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phpDocumentationSource;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frenchPhpDocumentationQuality;

    /**
     * @ORM\ManyToMany(targetEntity="Certification")
     * @var Collection
     */
    private $certifications;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private $phpStrength;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $hasRecentTraining;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @var bool
     */
    private $isRecentTrainingHadSalaryImpact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private $gender;

    /**
     */
    public function __construct()
    {
        $this->certifications = new ArrayCollection();
        $this->specialities = new ArrayCollection();
        $this->containerEnvironmentsUsage = new ArrayCollection();
        $this->hostingTypes = new ArrayCollection();
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
     *
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
     *
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
     * @param integer $annualSalary
     *
     * @return Response
     */
    public function setAnnualSalary($annualSalary)
    {
        $this->annualSalary = $annualSalary;

        return $this;
    }

    /**
     * @return integer
     */
    public function getAnnualSalary()
    {
        return $this->annualSalary;
    }

    /**
     * @param integer $salarySatisfaction
     *
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
     *
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
     *
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
     * @param integer $jobTitle
     *
     * @return Response
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return integer
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param integer $experience
     *
     * @return Response
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param integer $companyType
     *
     * @return Response
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * @param integer $companySize
     *
     * @return Response
     */
    public function setCompanySize($companySize)
    {
        $this->companySize = $companySize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanySize()
    {
        return $this->companySize;
    }

    /**
     * @param integer $companyDepartment
     *
     * @return Response
     */
    public function setCompanyDepartment($companyDepartment)
    {
        $this->companyDepartment = str_pad($companyDepartment, 2, "0", STR_PAD_LEFT);

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyDepartment()
    {
        return $this->companyDepartment;
    }

    /**
     * @param integer $jobInterest
     *
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
     *
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
     *
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
     *
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
     * @param boolean $recentTrainingHadSalaryImpact
     *
     * @return Response
     */
    public function setRecentTrainingHadSalaryImpact($recentTrainingHadSalaryImpact)
    {
        $this->isRecentTrainingHadSalaryImpact = $recentTrainingHadSalaryImpact;

        return $this;
    }

    /**
     * @return boolean
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
     * @return Collection
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
     * @return Collection
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

    /**
     * @return string
     */
    public function getCompanyOrigin()
    {
        return $this->companyOrigin;
    }

    /**
     * @param string $companyOrigin
     */
    public function setCompanyOrigin($companyOrigin)
    {
        $this->companyOrigin = $companyOrigin;
    }

    /**
     * @return int
     */
    public function getFreelanceTjm()
    {
        return $this->freelanceTjm;
    }

    /**
     * @param int $freelanceTjm
     */
    public function setFreelanceTjm($freelanceTjm)
    {
        $this->freelanceTjm = $freelanceTjm;
    }

    /**
     * @return int
     */
    public function getFreelanceAverageWorkDayPerYear()
    {
        return $this->freelanceAverageWorkDayPerYear;
    }

    /**
     * @param int $freelanceAverageWorkDayPerYear
     */
    public function setFreelanceAverageWorkDayPerYear($freelanceAverageWorkDayPerYear)
    {
        $this->freelanceAverageWorkDayPerYear = $freelanceAverageWorkDayPerYear;
    }

    /**
     * @return int
     */
    public function getContractWorkDuration()
    {
        return $this->contractWorkDuration;
    }

    /**
     * @param int $contractWorkDuration
     */
    public function setContractWorkDuration($contractWorkDuration)
    {
        $this->contractWorkDuration = $contractWorkDuration;
    }

    /**
     * @return Collection
     */
    public function getHostingTypes()
    {
        return $this->hostingTypes;
    }

    /**
     * @param Collection $hostingTypes
     */
    public function setHostingTypes($hostingTypes)
    {
        $this->hostingTypes = $hostingTypes;
    }

    public function addHostingType($hostingType)
    {
        $this->hostingTypes[] = $hostingType;
    }

    /**
     * @return Collection
     */
    public function getContainerEnvironmentsUsage()
    {
        return $this->containerEnvironmentsUsage;
    }

    /**
     * @param Collection $containerEnvironmentsUsage
     */
    public function setContainerEnvironmentsUsage($containerEnvironmentsUsage)
    {
        $this->containerEnvironmentsUsage = $containerEnvironmentsUsage;
    }

    /**
     * @return int
     */
    public function getWorkMethod()
    {
        return $this->workMethod;
    }

    /**
     * @param int $workMethod
     */
    public function setWorkMethod($workMethod)
    {
        $this->workMethod = $workMethod;
    }

    /**
     * @return int
     */
    public function getPhpDocumentationSource()
    {
        return $this->phpDocumentationSource;
    }

    /**
     * @param int $phpDocumentationSource
     */
    public function setPhpDocumentationSource($phpDocumentationSource)
    {
        $this->phpDocumentationSource = $phpDocumentationSource;
    }

    /**
     * @return int
     */
    public function getFrenchPhpDocumentationQuality()
    {
        return $this->frenchPhpDocumentationQuality;
    }

    /**
     * @param int $frenchPhpDocumentationQuality
     */
    public function setFrenchPhpDocumentationQuality($frenchPhpDocumentationQuality)
    {
        $this->frenchPhpDocumentationQuality = $frenchPhpDocumentationQuality;
    }

    /**
     * @return bool
     */
    public function isRecentTrainingHadSalaryImpact()
    {
        return $this->isRecentTrainingHadSalaryImpact;
    }

    /**
     * @param bool $isRecentTrainingHadSalaryImpact
     */
    public function setIsRecentTrainingHadSalaryImpact($isRecentTrainingHadSalaryImpact)
    {
        $this->isRecentTrainingHadSalaryImpact = $isRecentTrainingHadSalaryImpact;
    }

    public function addContainerEnvironmentUsage(ContainerEnvironmentUsage $containerEnvironmentUsage)
    {
        $this->containerEnvironmentsUsage[] = $containerEnvironmentUsage;
    }
}
