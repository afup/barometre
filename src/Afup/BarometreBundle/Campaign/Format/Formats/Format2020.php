<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Campaign\Format\Formats;

class Format2020 extends Format2014
{
    public function getColumns()
    {
        return [
            '',
            'gross_annual_salary',
            'variable_annual_salary',
            'salary_satisfaction',
            'initial_training',
            'status',
            'job_title',
            'experience',
            'freelance_tjm',
            'freelance_average_work_day',
            'contract_work_duration',
            'company_department',
            'company_type',
            'company_size',
            'job_interest',
            'company_origin',
            'other_language',
            'remote_usage',
            'meetup_participation',
            'technological_watch',
            'os_developpment',
            'hosting_type',
            'container_environment_usage',
            'work_method',
            'speciality',
            'php_version',
            'php_documentation_source',
            'french_php_documentation_quality',
            'cms_usage_in_project', // Utilisez-vous un CMS dans votre/vos projet(s) courant?
            'has_certification',
            'certification_list',
            'php_strength',
            'has_formation',
            'formation_subject',
            'formation_impact',
            'covid19_company_trust', // Suite au COVID-19, quel est votre niveau de confiance dans la santé de votre entreprise ?
            'covid19_company_handle', // Comment trouvez-vous que votre entreprise a géré la crise du COVID-19 ?
            'covid19_layoff', // 	Y a-t-il eu des licenciements dûs au COVID-19 au sein de l'équipe technique de votre société ?
            'covid19_future_plan', //	Le COVID-19 a-t-il modifié vos projets de changement d'emploi ?
            'covid19_salary_impact', //	Pensez-vous que le COVID-19 va avoir un impact négatif sur votre progression salariale ?
            'covid19_partial_unemployment', //	Avez-vous été au chômage partiel ou en activité partielle ?
            'covid19_regular_remote_feeling', // 	Hors période de confinement, comment vivez-vous le télétravail régulier ?
            'covid19_remote_ideal_pace', //	Quel serait le rythme idéal en télétravail pour vous ? (en nombre de jour par semaine)
            'gender',
        ];
    }
}
