<?php

declare(strict_types=1);

namespace App\Campaign\Format\Formats;

class Format2023 extends Format2021
{
    public function getColumns()
    {
        return [
            '', // Horodateur,
            'gross_annual_salary', // Quelle est votre rémunération annuelle brute fixe  en euro ?
            'variable_annual_salary', // Quelle est votre rémunération annuelle brut variable (hors part fixe) en euro ?
            'salary_satisfaction', // Estimez-vous votre rémunération satisfaisante ?
            'salary_inflation', // Votre entreprise vous propose-t-elle à minima une réévaluation annuelle de votre rémunération du niveau de l’inflation ?
            'initial_training', // Quelle est votre formation initiale ?
            'retraining', // Venez-vous d'une reconversion ?
            'status', // Quel est votre statut actuel ?
            'job_title', // Quel est l'intitulé de votre poste actuel ?
            'contract_work_duration', // Quelle est votre durée de travail contractuelle ?
            'experience_in_year', // Quel est votre nombre d'année d'expérience total ?
            'experience_in_current_job', // Quel est votre nombre d'année d'expérience dans votre entreprise actuelle ?
            'leave_job', // Si vous avez cherché à changer de poste en cette année, est-ce que vous avez ?
            'freelance_tjm', // Quelle est votre TJM en euro ?
            'freelance_average_work_day', // Quel est votre nombre de jours travaillé en moyenne dans l’année ?
            'company_department', // Quel est votre département de travail ?,
            'company_type', // Dans quel type d'entreprise travaillez-vous ?,
            'company_size', // Taille de votre entreprise,
            'job_interest', // Quels sont les aspects les plus importants dans votre emploi actuel ?
            'company_origin', // "Si elle n'est pas française, quelle est l'origine de votre entreprise ou maison mère ?"
            'discrimination_during_hiring', //Avez-vous le sentiment d'avoir été victime de discrimination à l'embauche ?
            'other_language', // "Développez-vous dans d'autres langages que PHP ? Si oui, quel est le principal ?"
            'remote_usage', // Travaillez-vous en télétravail ?,
            'remote_pace', // Quel serait le rythme idéal en télétravail pour vous ? (en nombre de jour par semaine),
            'technological_watch', // Faites-vous régulièrement de la veille technique ?,
            'os_developpment', // Sous quel OS développez-vous principalement ?,
            'number_meetup_participation', // À combien d'événement / meetup tech avez-vous participé sur la dernière année ?,
            'community_inclusion', //Est-ce que vous pensez que l'AFUP, sa communauté et ses événements sont inclusifs ?
            'speciality', // Quelle est votre plus grande spécialité ?,
            'php_version', // Quelle version de PHP utilisez-vous au quotidien ?,
            'php_strength', // "D'après vous, quelle est la plus grande force de PHP ?"
            'has_formation', // Avez-vous suivi une formation au cours de ces deux dernières années ?,
            'formation_subject', // Sur quel(s) sujet(s) avez-vous été formés ?,
            'formation_impact', // Cela a-t-il eu une incidence sur votre emploi/rémunération ?,
            'gender', // Vous êtes
            'age', //Quel âge avez-vous ?
        ];
    }
}
