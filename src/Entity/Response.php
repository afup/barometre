<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'response')]
class Response
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Campaign::class)]
    #[ORM\JoinColumn(name: 'campaign_id', referencedColumnName: 'id')]
    private Campaign $campaign;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $grossAnnualSalary = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $variableAnnualSalary = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $annualSalary = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $salarySatisfaction = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $initialTraining = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $retraining = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $status = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $jobTitle = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $experience;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $freelanceTjm = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $freelanceAverageWorkDayPerYear = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $contractWorkDuration = null;

    #[ORM\Column(type: 'string', length: 3, nullable: true)]
    private ?string $companyDepartment = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $companyType = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $companySize = null;

    #[ORM\ManyToMany(targetEntity: JobInterest::class)]
    private Collection $jobInterests;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $companyOrigin = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $otherLanguage = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $remoteUsage = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $remotePace = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $meetupParticipation = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $technologicalWatch = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $osDeveloppment = null;

    #[ORM\ManyToMany(targetEntity: HostingType::class)]
    private Collection $hostingTypes;

    #[ORM\ManyToMany(targetEntity: ContainerEnvironmentUsage::class)]
    private Collection $containerEnvironmentsUsage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $workMethod = null;

    #[ORM\ManyToMany(targetEntity: Speciality::class)]
    private Collection $specialities;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $phpVersion = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $phpDocumentationSource = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $frenchPhpDocumentationQuality = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $cmsUsageInProject = null;

    #[ORM\ManyToMany(targetEntity: Certification::class)]
    private Collection $certifications;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $phpStrength = null;

    #[ORM\Column(type: 'boolean')]
    private bool $hasRecentTraining;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isRecentTrainingHadSalaryImpact = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19CompanyTrust = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19CompanyHandle = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19Layoff = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19FuturePlan = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19SalaryImpact = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19PartialUnemployment = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19RegularRemoteFeeling = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19RemoteIdealPace = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $covid19WorkCondition = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $gender = null;

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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function setId(int $id): Response
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Campaign
     */
    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     *
     * @return Response
     */
    public function setCampaign(Campaign $campaign): Response
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGrossAnnualSalary(): ?int
    {
        return $this->grossAnnualSalary;
    }

    /**
     * @param int|null $grossAnnualSalary
     *
     * @return Response
     */
    public function setGrossAnnualSalary(?int $grossAnnualSalary): Response
    {
        $this->grossAnnualSalary = $grossAnnualSalary;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVariableAnnualSalary(): ?int
    {
        return $this->variableAnnualSalary;
    }

    /**
     * @param int|null $variableAnnualSalary
     *
     * @return Response
     */
    public function setVariableAnnualSalary(?int $variableAnnualSalary): Response
    {
        $this->variableAnnualSalary = $variableAnnualSalary;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAnnualSalary(): ?int
    {
        return $this->annualSalary;
    }

    /**
     * @param int|null $annualSalary
     *
     * @return Response
     */
    public function setAnnualSalary(?int $annualSalary): Response
    {
        $this->annualSalary = $annualSalary;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSalarySatisfaction(): ?int
    {
        return $this->salarySatisfaction;
    }

    /**
     * @param int|null $salarySatisfaction
     *
     * @return Response
     */
    public function setSalarySatisfaction(?int $salarySatisfaction): Response
    {
        $this->salarySatisfaction = $salarySatisfaction;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInitialTraining(): ?int
    {
        return $this->initialTraining;
    }

    /**
     * @param int|null $initialTraining
     *
     * @return Response
     */
    public function setInitialTraining(?int $initialTraining): Response
    {
        $this->initialTraining = $initialTraining;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRetraining(): ?int
    {
        return $this->retraining;
    }

    /**
     * @param int|null $retraining
     *
     * @return Response
     */
    public function setRetraining(?int $retraining): Response
    {
        $this->retraining = $retraining;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     *
     * @return Response
     */
    public function setStatus(?int $status): Response
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getJobTitle(): ?int
    {
        return $this->jobTitle;
    }

    /**
     * @param int|null $jobTitle
     *
     * @return Response
     */
    public function setJobTitle(?int $jobTitle): Response
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExperience(): ?int
    {
        return $this->experience;
    }

    /**
     * @param int|null $experience
     *
     * @return Response
     */
    public function setExperience(?int $experience): Response
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFreelanceTjm(): ?int
    {
        return $this->freelanceTjm;
    }

    /**
     * @param int|null $freelanceTjm
     *
     * @return Response
     */
    public function setFreelanceTjm(?int $freelanceTjm): Response
    {
        $this->freelanceTjm = $freelanceTjm;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFreelanceAverageWorkDayPerYear(): ?int
    {
        return $this->freelanceAverageWorkDayPerYear;
    }

    /**
     * @param int|null $freelanceAverageWorkDayPerYear
     *
     * @return Response
     */
    public function setFreelanceAverageWorkDayPerYear(?int $freelanceAverageWorkDayPerYear): Response
    {
        $this->freelanceAverageWorkDayPerYear = $freelanceAverageWorkDayPerYear;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getContractWorkDuration(): ?int
    {
        return $this->contractWorkDuration;
    }

    /**
     * @param int|null $contractWorkDuration
     *
     * @return Response
     */
    public function setContractWorkDuration(?int $contractWorkDuration): Response
    {
        $this->contractWorkDuration = $contractWorkDuration;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyDepartment(): ?string
    {
        return $this->companyDepartment;
    }

    /**
     * @param string|null $companyDepartment
     *
     * @return Response
     */
    public function setCompanyDepartment(?string $companyDepartment): Response
    {
        $this->companyDepartment = $companyDepartment;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCompanyType(): ?int
    {
        return $this->companyType;
    }

    /**
     * @param int|null $companyType
     *
     * @return Response
     */
    public function setCompanyType(?int $companyType): Response
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCompanySize(): ?int
    {
        return $this->companySize;
    }

    /**
     * @param int|null $companySize
     *
     * @return Response
     */
    public function setCompanySize(?int $companySize): Response
    {
        $this->companySize = $companySize;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getJobInterests(): Collection
    {
        return $this->jobInterests;
    }

    /**
     * @param Collection $jobInterests
     *
     * @return Response
     */
    public function setJobInterests(Collection $jobInterests): Response
    {
        $this->jobInterests = $jobInterests;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyOrigin(): ?string
    {
        return $this->companyOrigin;
    }

    /**
     * @param string|null $companyOrigin
     *
     * @return Response
     */
    public function setCompanyOrigin(?string $companyOrigin): Response
    {
        $this->companyOrigin = $companyOrigin;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOtherLanguage(): ?int
    {
        return $this->otherLanguage;
    }

    /**
     * @param int|null $otherLanguage
     *
     * @return Response
     */
    public function setOtherLanguage(?int $otherLanguage): Response
    {
        $this->otherLanguage = $otherLanguage;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemoteUsage(): ?int
    {
        return $this->remoteUsage;
    }

    /**
     * @param int|null $remoteUsage
     *
     * @return Response
     */
    public function setRemoteUsage(?int $remoteUsage): Response
    {
        $this->remoteUsage = $remoteUsage;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemotePace(): ?int
    {
        return $this->remotePace;
    }

    /**
     * @param int|null $remotePace
     *
     * @return Response
     */
    public function setRemotePace(?int $remotePace): Response
    {
        $this->remotePace = $remotePace;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMeetupParticipation(): ?int
    {
        return $this->meetupParticipation;
    }

    /**
     * @param int|null $meetupParticipation
     *
     * @return Response
     */
    public function setMeetupParticipation(?int $meetupParticipation): Response
    {
        $this->meetupParticipation = $meetupParticipation;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTechnologicalWatch(): ?int
    {
        return $this->technologicalWatch;
    }

    /**
     * @param int|null $technologicalWatch
     *
     * @return Response
     */
    public function setTechnologicalWatch(?int $technologicalWatch): Response
    {
        $this->technologicalWatch = $technologicalWatch;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOsDeveloppment(): ?int
    {
        return $this->osDeveloppment;
    }

    /**
     * @param int|null $osDeveloppment
     *
     * @return Response
     */
    public function setOsDeveloppment(?int $osDeveloppment): Response
    {
        $this->osDeveloppment = $osDeveloppment;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getHostingTypes(): Collection
    {
        return $this->hostingTypes;
    }

    /**
     * @param Collection $hostingTypes
     *
     * @return Response
     */
    public function setHostingTypes(Collection $hostingTypes): Response
    {
        $this->hostingTypes = $hostingTypes;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getContainerEnvironmentsUsage(): Collection
    {
        return $this->containerEnvironmentsUsage;
    }

    /**
     * @param Collection $containerEnvironmentsUsage
     *
     * @return Response
     */
    public function setContainerEnvironmentsUsage(Collection $containerEnvironmentsUsage): Response
    {
        $this->containerEnvironmentsUsage = $containerEnvironmentsUsage;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWorkMethod(): ?int
    {
        return $this->workMethod;
    }

    /**
     * @param int|null $workMethod
     *
     * @return Response
     */
    public function setWorkMethod(?int $workMethod): Response
    {
        $this->workMethod = $workMethod;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSpecialities(): Collection
    {
        return $this->specialities;
    }

    /**
     * @param Collection $specialities
     *
     * @return Response
     */
    public function setSpecialities(Collection $specialities): Response
    {
        $this->specialities = $specialities;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPhpVersion(): ?int
    {
        return $this->phpVersion;
    }

    /**
     * @param int|null $phpVersion
     *
     * @return Response
     */
    public function setPhpVersion(?int $phpVersion): Response
    {
        $this->phpVersion = $phpVersion;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPhpDocumentationSource(): ?int
    {
        return $this->phpDocumentationSource;
    }

    /**
     * @param int|null $phpDocumentationSource
     *
     * @return Response
     */
    public function setPhpDocumentationSource(?int $phpDocumentationSource): Response
    {
        $this->phpDocumentationSource = $phpDocumentationSource;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFrenchPhpDocumentationQuality(): ?int
    {
        return $this->frenchPhpDocumentationQuality;
    }

    /**
     * @param int|null $frenchPhpDocumentationQuality
     *
     * @return Response
     */
    public function setFrenchPhpDocumentationQuality(?int $frenchPhpDocumentationQuality): Response
    {
        $this->frenchPhpDocumentationQuality = $frenchPhpDocumentationQuality;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCmsUsageInProject(): ?int
    {
        return $this->cmsUsageInProject;
    }

    /**
     * @param int|null $cmsUsageInProject
     *
     * @return Response
     */
    public function setCmsUsageInProject(?int $cmsUsageInProject): Response
    {
        $this->cmsUsageInProject = $cmsUsageInProject;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCertifications(): Collection
    {
        return $this->certifications;
    }

    /**
     * @param Collection $certifications
     *
     * @return Response
     */
    public function setCertifications(Collection $certifications): Response
    {
        $this->certifications = $certifications;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPhpStrength(): ?int
    {
        return $this->phpStrength;
    }

    /**
     * @param int|null $phpStrength
     *
     * @return Response
     */
    public function setPhpStrength(?int $phpStrength): Response
    {
        $this->phpStrength = $phpStrength;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHasRecentTraining(): bool
    {
        return $this->hasRecentTraining;
    }

    /**
     * @param bool $hasRecentTraining
     *
     * @return Response
     */
    public function setHasRecentTraining(bool $hasRecentTraining): Response
    {
        $this->hasRecentTraining = $hasRecentTraining;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsRecentTrainingHadSalaryImpact(): ?bool
    {
        return $this->isRecentTrainingHadSalaryImpact;
    }

    /**
     * @param bool|null $isRecentTrainingHadSalaryImpact
     *
     * @return Response
     */
    public function setIsRecentTrainingHadSalaryImpact(?bool $isRecentTrainingHadSalaryImpact): Response
    {
        $this->isRecentTrainingHadSalaryImpact = $isRecentTrainingHadSalaryImpact;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19CompanyTrust(): ?int
    {
        return $this->covid19CompanyTrust;
    }

    /**
     * @param int|null $covid19CompanyTrust
     *
     * @return Response
     */
    public function setCovid19CompanyTrust(?int $covid19CompanyTrust): Response
    {
        $this->covid19CompanyTrust = $covid19CompanyTrust;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19CompanyHandle(): ?int
    {
        return $this->covid19CompanyHandle;
    }

    /**
     * @param int|null $covid19CompanyHandle
     *
     * @return Response
     */
    public function setCovid19CompanyHandle(?int $covid19CompanyHandle): Response
    {
        $this->covid19CompanyHandle = $covid19CompanyHandle;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19Layoff(): ?int
    {
        return $this->covid19Layoff;
    }

    /**
     * @param int|null $covid19Layoff
     *
     * @return Response
     */
    public function setCovid19Layoff(?int $covid19Layoff): Response
    {
        $this->covid19Layoff = $covid19Layoff;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19FuturePlan(): ?int
    {
        return $this->covid19FuturePlan;
    }

    /**
     * @param int|null $covid19FuturePlan
     *
     * @return Response
     */
    public function setCovid19FuturePlan(?int $covid19FuturePlan): Response
    {
        $this->covid19FuturePlan = $covid19FuturePlan;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19SalaryImpact(): ?int
    {
        return $this->covid19SalaryImpact;
    }

    /**
     * @param int|null $covid19SalaryImpact
     *
     * @return Response
     */
    public function setCovid19SalaryImpact(?int $covid19SalaryImpact): Response
    {
        $this->covid19SalaryImpact = $covid19SalaryImpact;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19PartialUnemployment(): ?int
    {
        return $this->covid19PartialUnemployment;
    }

    /**
     * @param int|null $covid19PartialUnemployment
     *
     * @return Response
     */
    public function setCovid19PartialUnemployment(?int $covid19PartialUnemployment): Response
    {
        $this->covid19PartialUnemployment = $covid19PartialUnemployment;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19RegularRemoteFeeling(): ?int
    {
        return $this->covid19RegularRemoteFeeling;
    }

    /**
     * @param int|null $covid19RegularRemoteFeeling
     *
     * @return Response
     */
    public function setCovid19RegularRemoteFeeling(?int $covid19RegularRemoteFeeling): Response
    {
        $this->covid19RegularRemoteFeeling = $covid19RegularRemoteFeeling;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19RemoteIdealPace(): ?int
    {
        return $this->covid19RemoteIdealPace;
    }

    /**
     * @param int|null $covid19RemoteIdealPace
     *
     * @return Response
     */
    public function setCovid19RemoteIdealPace(?int $covid19RemoteIdealPace): Response
    {
        $this->covid19RemoteIdealPace = $covid19RemoteIdealPace;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCovid19WorkCondition(): ?int
    {
        return $this->covid19WorkCondition;
    }

    /**
     * @param int|null $covid19WorkCondition
     *
     * @return Response
     */
    public function setCovid19WorkCondition(?int $covid19WorkCondition): Response
    {
        $this->covid19WorkCondition = $covid19WorkCondition;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * @param int|null $gender
     *
     * @return Response
     */
    public function setGender(?int $gender): Response
    {
        $this->gender = $gender;

        return $this;
    }
}
