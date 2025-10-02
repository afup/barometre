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

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $leaveJob = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $discriminationDuringHiring = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $communityInclusion = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $useGenerativeAI = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $includeAiInProject = null;

    public function __construct()
    {
        $this->certifications = new ArrayCollection();
        $this->specialities = new ArrayCollection();
        $this->containerEnvironmentsUsage = new ArrayCollection();
        $this->hostingTypes = new ArrayCollection();
        $this->jobInterests = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function getGrossAnnualSalary(): ?int
    {
        return $this->grossAnnualSalary;
    }

    public function setGrossAnnualSalary(?int $grossAnnualSalary): self
    {
        $this->grossAnnualSalary = $grossAnnualSalary;

        return $this;
    }

    public function getVariableAnnualSalary(): ?int
    {
        return $this->variableAnnualSalary;
    }

    public function setVariableAnnualSalary(?int $variableAnnualSalary): self
    {
        $this->variableAnnualSalary = $variableAnnualSalary;

        return $this;
    }

    public function getAnnualSalary(): ?int
    {
        return $this->annualSalary;
    }

    public function setAnnualSalary(?int $annualSalary): self
    {
        $this->annualSalary = $annualSalary;

        return $this;
    }

    public function getSalarySatisfaction(): ?int
    {
        return $this->salarySatisfaction;
    }

    public function setSalarySatisfaction(?int $salarySatisfaction): self
    {
        $this->salarySatisfaction = $salarySatisfaction;

        return $this;
    }

    public function getInitialTraining(): ?int
    {
        return $this->initialTraining;
    }

    public function setInitialTraining(?int $initialTraining): self
    {
        $this->initialTraining = $initialTraining;

        return $this;
    }

    public function getRetraining(): ?int
    {
        return $this->retraining;
    }

    public function setRetraining(?int $retraining): self
    {
        $this->retraining = $retraining;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getJobTitle(): ?int
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?int $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getFreelanceTjm(): ?int
    {
        return $this->freelanceTjm;
    }

    public function setFreelanceTjm(?int $freelanceTjm): self
    {
        $this->freelanceTjm = $freelanceTjm;

        return $this;
    }

    public function getFreelanceAverageWorkDayPerYear(): ?int
    {
        return $this->freelanceAverageWorkDayPerYear;
    }

    public function setFreelanceAverageWorkDayPerYear(?int $freelanceAverageWorkDayPerYear): self
    {
        $this->freelanceAverageWorkDayPerYear = $freelanceAverageWorkDayPerYear;

        return $this;
    }

    public function getContractWorkDuration(): ?int
    {
        return $this->contractWorkDuration;
    }

    public function setContractWorkDuration(?int $contractWorkDuration): self
    {
        $this->contractWorkDuration = $contractWorkDuration;

        return $this;
    }

    public function getCompanyDepartment(): ?string
    {
        return $this->companyDepartment;
    }

    public function setCompanyDepartment(?string $companyDepartment): self
    {
        $this->companyDepartment = $companyDepartment;

        return $this;
    }

    public function getCompanyType(): ?int
    {
        return $this->companyType;
    }

    public function setCompanyType(?int $companyType): self
    {
        $this->companyType = $companyType;

        return $this;
    }

    public function getCompanySize(): ?int
    {
        return $this->companySize;
    }

    public function setCompanySize(?int $companySize): self
    {
        $this->companySize = $companySize;

        return $this;
    }

    public function getJobInterests(): Collection
    {
        return $this->jobInterests;
    }

    public function setJobInterests(Collection $jobInterests): self
    {
        $this->jobInterests = $jobInterests;

        return $this;
    }

    public function getCompanyOrigin(): ?string
    {
        return $this->companyOrigin;
    }

    public function setCompanyOrigin(?string $companyOrigin): self
    {
        $this->companyOrigin = $companyOrigin;

        return $this;
    }

    public function getOtherLanguage(): ?int
    {
        return $this->otherLanguage;
    }

    public function setOtherLanguage(?int $otherLanguage): self
    {
        $this->otherLanguage = $otherLanguage;

        return $this;
    }

    public function getRemoteUsage(): ?int
    {
        return $this->remoteUsage;
    }

    public function setRemoteUsage(?int $remoteUsage): self
    {
        $this->remoteUsage = $remoteUsage;

        return $this;
    }

    public function getRemotePace(): ?int
    {
        return $this->remotePace;
    }

    public function setRemotePace(?int $remotePace): self
    {
        $this->remotePace = $remotePace;

        return $this;
    }

    public function getMeetupParticipation(): ?int
    {
        return $this->meetupParticipation;
    }

    public function setMeetupParticipation(?int $meetupParticipation): self
    {
        $this->meetupParticipation = $meetupParticipation;

        return $this;
    }

    public function getTechnologicalWatch(): ?int
    {
        return $this->technologicalWatch;
    }

    public function setTechnologicalWatch(?int $technologicalWatch): self
    {
        $this->technologicalWatch = $technologicalWatch;

        return $this;
    }

    public function getOsDeveloppment(): ?int
    {
        return $this->osDeveloppment;
    }

    public function setOsDeveloppment(?int $osDeveloppment): self
    {
        $this->osDeveloppment = $osDeveloppment;

        return $this;
    }

    public function getHostingTypes(): Collection
    {
        return $this->hostingTypes;
    }

    public function setHostingTypes(Collection $hostingTypes): self
    {
        $this->hostingTypes = $hostingTypes;

        return $this;
    }

    public function getContainerEnvironmentsUsage(): Collection
    {
        return $this->containerEnvironmentsUsage;
    }

    public function setContainerEnvironmentsUsage(Collection $containerEnvironmentsUsage): self
    {
        $this->containerEnvironmentsUsage = $containerEnvironmentsUsage;

        return $this;
    }

    public function getWorkMethod(): ?int
    {
        return $this->workMethod;
    }

    public function setWorkMethod(?int $workMethod): self
    {
        $this->workMethod = $workMethod;

        return $this;
    }

    public function getSpecialities(): Collection
    {
        return $this->specialities;
    }

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

    public function getPhpVersion(): ?int
    {
        return $this->phpVersion;
    }

    public function setPhpVersion(?int $phpVersion): self
    {
        $this->phpVersion = $phpVersion;

        return $this;
    }

    public function getPhpDocumentationSource(): ?int
    {
        return $this->phpDocumentationSource;
    }

    public function setPhpDocumentationSource(?int $phpDocumentationSource): self
    {
        $this->phpDocumentationSource = $phpDocumentationSource;

        return $this;
    }

    public function getFrenchPhpDocumentationQuality(): ?int
    {
        return $this->frenchPhpDocumentationQuality;
    }

    public function setFrenchPhpDocumentationQuality(?int $frenchPhpDocumentationQuality): self
    {
        $this->frenchPhpDocumentationQuality = $frenchPhpDocumentationQuality;

        return $this;
    }

    public function getCmsUsageInProject(): ?int
    {
        return $this->cmsUsageInProject;
    }

    public function setCmsUsageInProject(?int $cmsUsageInProject): self
    {
        $this->cmsUsageInProject = $cmsUsageInProject;

        return $this;
    }

    public function getCertifications(): Collection
    {
        return $this->certifications;
    }

    public function addCertification(Certification $certification): self
    {
        $this->certifications->add($certification);

        return $this;
    }

    public function setCertifications(Collection $certifications): self
    {
        $this->certifications = $certifications;

        return $this;
    }

    public function getPhpStrength(): ?int
    {
        return $this->phpStrength;
    }

    public function setPhpStrength(?int $phpStrength): self
    {
        $this->phpStrength = $phpStrength;

        return $this;
    }

    public function isHasRecentTraining(): bool
    {
        return $this->hasRecentTraining;
    }

    public function setHasRecentTraining(bool $hasRecentTraining): self
    {
        $this->hasRecentTraining = $hasRecentTraining;

        return $this;
    }

    public function getIsRecentTrainingHadSalaryImpact(): ?bool
    {
        return $this->isRecentTrainingHadSalaryImpact;
    }

    public function setIsRecentTrainingHadSalaryImpact(?bool $isRecentTrainingHadSalaryImpact): self
    {
        $this->isRecentTrainingHadSalaryImpact = $isRecentTrainingHadSalaryImpact;

        return $this;
    }

    public function getCovid19CompanyTrust(): ?int
    {
        return $this->covid19CompanyTrust;
    }

    public function setCovid19CompanyTrust(?int $covid19CompanyTrust): self
    {
        $this->covid19CompanyTrust = $covid19CompanyTrust;

        return $this;
    }

    public function getCovid19CompanyHandle(): ?int
    {
        return $this->covid19CompanyHandle;
    }

    public function setCovid19CompanyHandle(?int $covid19CompanyHandle): self
    {
        $this->covid19CompanyHandle = $covid19CompanyHandle;

        return $this;
    }

    public function getCovid19Layoff(): ?int
    {
        return $this->covid19Layoff;
    }

    public function setCovid19Layoff(?int $covid19Layoff): self
    {
        $this->covid19Layoff = $covid19Layoff;

        return $this;
    }

    public function getCovid19FuturePlan(): ?int
    {
        return $this->covid19FuturePlan;
    }

    public function setCovid19FuturePlan(?int $covid19FuturePlan): self
    {
        $this->covid19FuturePlan = $covid19FuturePlan;

        return $this;
    }

    public function getCovid19SalaryImpact(): ?int
    {
        return $this->covid19SalaryImpact;
    }

    public function setCovid19SalaryImpact(?int $covid19SalaryImpact): self
    {
        $this->covid19SalaryImpact = $covid19SalaryImpact;

        return $this;
    }

    public function getCovid19PartialUnemployment(): ?int
    {
        return $this->covid19PartialUnemployment;
    }

    public function setCovid19PartialUnemployment(?int $covid19PartialUnemployment): self
    {
        $this->covid19PartialUnemployment = $covid19PartialUnemployment;

        return $this;
    }

    public function getCovid19RegularRemoteFeeling(): ?int
    {
        return $this->covid19RegularRemoteFeeling;
    }

    public function setCovid19RegularRemoteFeeling(?int $covid19RegularRemoteFeeling): self
    {
        $this->covid19RegularRemoteFeeling = $covid19RegularRemoteFeeling;

        return $this;
    }

    public function getCovid19RemoteIdealPace(): ?int
    {
        return $this->covid19RemoteIdealPace;
    }

    public function setCovid19RemoteIdealPace(?int $covid19RemoteIdealPace): self
    {
        $this->covid19RemoteIdealPace = $covid19RemoteIdealPace;

        return $this;
    }

    public function getCovid19WorkCondition(): ?int
    {
        return $this->covid19WorkCondition;
    }

    public function setCovid19WorkCondition(?int $covid19WorkCondition): self
    {
        $this->covid19WorkCondition = $covid19WorkCondition;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

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

    public function getExperienceInYear(): ?int
    {
        return $this->experienceInYear;
    }

    public function setExperienceInYear(?int $experienceInYear): self
    {
        $this->experienceInYear = $experienceInYear;

        return $this;
    }

    public function getExperienceInCurrentJob(): ?int
    {
        return $this->experienceInCurrentJob;
    }

    public function setExperienceInCurrentJob(?int $experienceInCurrentJob): self
    {
        $this->experienceInCurrentJob = $experienceInCurrentJob;

        return $this;
    }

    public function getRemoteMoney(): ?int
    {
        return $this->remoteMoney;
    }

    public function setRemoteMoney(?int $remoteMoney): self
    {
        $this->remoteMoney = $remoteMoney;

        return $this;
    }

    public function getNumberMeetupParticipation(): ?int
    {
        return $this->numberMeetupParticipation;
    }

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

    public function getLeaveJob(): ?int
    {
        return $this->leaveJob;
    }

    public function setLeaveJob(?int $leaveJob): self
    {
        $this->leaveJob = $leaveJob;

        return $this;
    }

    public function getDiscriminationDuringHiring(): ?int
    {
        return $this->discriminationDuringHiring;
    }

    public function setDiscriminationDuringHiring(?int $discriminationDuringHiring): self
    {
        $this->discriminationDuringHiring = $discriminationDuringHiring;

        return $this;
    }

    public function getCommunityInclusion(): ?int
    {
        return $this->communityInclusion;
    }

    public function setCommunityInclusion(?int $communityInclusion): self
    {
        $this->communityInclusion = $communityInclusion;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getUseGenerativeAI(): ?bool
    {
        return $this->useGenerativeAI;
    }

    public function setUseGenerativeAI(?bool $useGenerativeAI): self
    {
        $this->useGenerativeAI = $useGenerativeAI;

        return $this;
    }

    public function getIncludeAiInProject(): ?bool
    {
        return $this->includeAiInProject;
    }

    public function setIncludeAiInProject(?bool $includeAiInProject): self
    {
        $this->includeAiInProject = $includeAiInProject;

        return $this;
    }
}
