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

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $salaryInflation = null;
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $experienceInYear = null;
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $experienceInCurrentJob = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $remoteMoney = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $numberMeetupParticipation = null;

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
    public function setId(int $id): self
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
    public function setCampaign(Campaign $campaign): self
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
    public function setGrossAnnualSalary(?int $grossAnnualSalary): self
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
    public function setVariableAnnualSalary(?int $variableAnnualSalary): self
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
    public function setAnnualSalary(?int $annualSalary): self
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
    public function setSalarySatisfaction(?int $salarySatisfaction): self
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
    public function setInitialTraining(?int $initialTraining): self
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
    public function setRetraining(?int $retraining): self
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
    public function setStatus(?int $status): self
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
    public function setJobTitle(?int $jobTitle): self
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
    public function setExperience(?int $experience): self
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
    public function setFreelanceTjm(?int $freelanceTjm): self
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
    public function setFreelanceAverageWorkDayPerYear(?int $freelanceAverageWorkDayPerYear): self
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
    public function setContractWorkDuration(?int $contractWorkDuration): self
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
    public function setCompanyDepartment(?string $companyDepartment): self
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
    public function setCompanyType(?int $companyType): self
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
    public function setCompanySize(?int $companySize): self
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
    public function setJobInterests(Collection $jobInterests): self
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
    public function setCompanyOrigin(?string $companyOrigin): self
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
    public function setOtherLanguage(?int $otherLanguage): self
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
    public function setRemoteUsage(?int $remoteUsage): self
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
    public function setRemotePace(?int $remotePace): self
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
    public function setMeetupParticipation(?int $meetupParticipation): self
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
    public function setTechnologicalWatch(?int $technologicalWatch): self
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
    public function setOsDeveloppment(?int $osDeveloppment): self
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
    public function setHostingTypes(Collection $hostingTypes): self
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
    public function setContainerEnvironmentsUsage(Collection $containerEnvironmentsUsage): self
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
    public function setWorkMethod(?int $workMethod): self
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
    public function setSpecialities(Collection $specialities): self
    {
        $this->specialities = $specialities;

        return $this;
    }

    public function addSpeciality(Speciality $speciality): self
    {
        $this->specialities->add($speciality);

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
    public function setPhpVersion(?int $phpVersion): self
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
    public function setPhpDocumentationSource(?int $phpDocumentationSource): self
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
    public function setFrenchPhpDocumentationQuality(?int $frenchPhpDocumentationQuality): self
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
    public function setCmsUsageInProject(?int $cmsUsageInProject): self
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

    public function addCertification(Certification $certification): self
    {
        $this->certifications->add($certification);

        return $this;
    }

    /**
     * @param Collection $certifications
     *
     * @return Response
     */
    public function setCertifications(Collection $certifications): self
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
    public function setPhpStrength(?int $phpStrength): self
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
    public function setHasRecentTraining(bool $hasRecentTraining): self
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
    public function setIsRecentTrainingHadSalaryImpact(?bool $isRecentTrainingHadSalaryImpact): self
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
    public function setCovid19CompanyTrust(?int $covid19CompanyTrust): self
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
    public function setCovid19CompanyHandle(?int $covid19CompanyHandle): self
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
    public function setCovid19Layoff(?int $covid19Layoff): self
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
    public function setCovid19FuturePlan(?int $covid19FuturePlan): self
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
    public function setCovid19SalaryImpact(?int $covid19SalaryImpact): self
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
    public function setCovid19PartialUnemployment(?int $covid19PartialUnemployment): self
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
    public function setCovid19RegularRemoteFeeling(?int $covid19RegularRemoteFeeling): self
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
    public function setCovid19RemoteIdealPace(?int $covid19RemoteIdealPace): self
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
    public function setCovid19WorkCondition(?int $covid19WorkCondition): self
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
    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getSalaryInflation(): ?int
    {
        return $this->salaryInflation;
    }

    public function setSalaryInflation(?int $salaryInflation): self
    {
        $this->salaryInflation = $salaryInflation;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExperienceInYear(): ?int
    {
        return $this->experienceInYear;
    }

    public function setExperienceInYear(?int $experienceInYear): self
    {
        $this->experienceInYear = $experienceInYear;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExperienceInCurrentJob(): ?int
    {
        return $this->experienceInCurrentJob;
    }

    /**
     * @param int|null $experienceInCurrentJob
     */
    public function setExperienceInCurrentJob(?int $experienceInCurrentJob): self
    {
        $this->experienceInCurrentJob = $experienceInCurrentJob;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemoteMoney(): ?int
    {
        return $this->remoteMoney;
    }

    /**
     * @param int|null $remoteMoney
     *
     * @return Response
     */
    public function setRemoteMoney(?int $remoteMoney): self
    {
        $this->remoteMoney = $remoteMoney;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberMeetupParticipation(): ?int
    {
        return $this->numberMeetupParticipation;
    }

    /**
     * @param int|null $numberMeetupParticipation
     */
    public function setNumberMeetupParticipation(?int $numberMeetupParticipation): self
    {
        $this->numberMeetupParticipation = $numberMeetupParticipation;

        return $this;
    }

    public function addHostingType(HostingType $hostingType): self
    {
        $this->hostingTypes->add($hostingType);

        return $this;
    }

    public function addContainerEnvironmentUsage(ContainerEnvironmentUsage $containerEnvironmentUsage): self
    {
        $this->containerEnvironmentsUsage->add($containerEnvironmentUsage);

        return $this;
    }

    public function addJobInterest(JobInterest $jobInterest): self
    {
        $this->jobInterests->add($jobInterest);

        return $this;
    }
}
