<?php

declare(strict_types=1);

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
    private $retraining;

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
     * @ORM\ManyToMany (targetEntity="JobInterest")
     *
     * @var Collection
     */
    private $jobInterests;

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
    private $remotePace;

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
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cmsUsageInProject;

    /**
     * @ORM\ManyToMany(targetEntity="Certification")
     *
     * @var Collection
     */
    private $certifications;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $phpStrength;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $hasRecentTraining;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var bool
     */
    private $isRecentTrainingHadSalaryImpact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19CompanyTrust;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19CompanyHandle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19Layoff;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19FuturePlan;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19SalaryImpact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19PartialUnemployment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19RegularRemoteFeeling;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19RemoteIdealPace;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $covid19WorkCondition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $gender;

    public function __construct()
    {
        $this->certifications = new ArrayCollection();
        $this->specialities = new ArrayCollection();
        $this->containerEnvironmentsUsage = new ArrayCollection();
        $this->hostingTypes = new ArrayCollection();
        $this->jobInterests = new ArrayCollection();
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
        $this->companyDepartment = str_pad((string) $companyDepartment, 2, '0', STR_PAD_LEFT);

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
     * @param JobInterest $jobInterests
     *
     * @return Response
     */
    public function addJobInterest(JobInterest $jobInterest)
    {
        $this->jobInterests[] = $jobInterest;

        return $this;
    }

    /**
     * @param JobInterest $jobInterests
     *
     * @return Response
     */
    public function removeJobInterest(JobInterest $jobInterest)
    {
        $this->jobInterests->removeElement($jobInterest);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getJobInterests()
    {
        return $this->jobInterests;
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
     * @return Response
     */
    public function addCertification(Certification $certifications)
    {
        $this->certifications[] = $certifications;

        return $this;
    }

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
     * @return Response
     */
    public function addSpeciality(Speciality $specialities)
    {
        $this->specialities[] = $specialities;

        return $this;
    }

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

    public function setCmsUsageInProject(int $cmsUsageInProject)
    {
        $this->cmsUsageInProject = $cmsUsageInProject;
    }

    public function setCovid19CompanyTrust(int $covid19CompanyTrust)
    {
        $this->covid19CompanyTrust = $covid19CompanyTrust;
    }

    public function setCovid19CompanyHandle(int $covid19CompanyHandle)
    {
        $this->covid19CompanyHandle = $covid19CompanyHandle;
    }

    public function setCovid19Layoff(int $covid19Layoff)
    {
        $this->covid19Layoff = $covid19Layoff;
    }

    public function setCovid19FuturePlan(int $covid19FuturePlan)
    {
        $this->covid19FuturePlan = $covid19FuturePlan;
    }

    public function setCovid19SalaryImpact(int $covid19SalaryImpact)
    {
        $this->covid19SalaryImpact = $covid19SalaryImpact;
    }

    public function setCovid19PartialUnemployment(int $covid19PartialUnemployment)
    {
        $this->covid19PartialUnemployment = $covid19PartialUnemployment;
    }

    public function setCovid19RegularRemoteFeeling(int $covid19RegularRemoteFeeling)
    {
        $this->covid19RegularRemoteFeeling = $covid19RegularRemoteFeeling;
    }

    public function setCovid19RemoteIdealPace(int $covid19RemoteIdealPace)
    {
        $this->covid19RemoteIdealPace = $covid19RemoteIdealPace;
    }

    /**
     * @return int
     */
    public function getRetraining(): int
    {
        return $this->retraining;
    }

    /**
     * @param int $retraining
     */
    public function setRetraining(int $retraining)
    {
        $this->retraining = $retraining;
    }

    /**
     * @return int
     */
    public function getRemotePace(): int
    {
        return $this->remotePace;
    }

    public function setRemotePace(int $remotePace)
    {
        $this->remotePace = $remotePace;
    }

    public function getCovid19WorkCondition(): int
    {
        return $this->covid19WorkCondition;
    }

    public function setCovid19WorkCondition(int $covid19WorkCondition)
    {
        $this->covid19WorkCondition = $covid19WorkCondition;
    }
}
