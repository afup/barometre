<?php

declare(strict_types=1);

namespace App\Campaign\Format\Formats;

use App\Campaign\Format\FormatInterface;

class Format2022 extends Format2021
{

    public function getColumns()
    {
        return [
            '', // Horodateur,
            'gross_annual_salary',//Quelle est votre rémunération annuelle brute fixe  en euro ?
            'variable_annual_salary',//,Quelle est votre rémunération annuelle brut variable (hors part fixe) en euro ?
            'salary_satisfaction',//,Estimez-vous votre rémunération satisfaisante ?
            'salary_inflation',//,Votre entreprise vous propose-t-elle à minima une réévaluation annuelle de votre rémunération du niveau de l’inflation ?
            'initial_training',//,Quelle est votre formation initiale ?
            'retraining',//,Venez-vous d'une reconversion ?
            'status',//,Quel est votre statut actuel ?
            'job_title',//,Quel est l'intitulé de votre poste actuel ?
            'experience_in_year',//,Quel est votre nombre d'année d'expérience total ?
            'experience_in_current_job',//,Quel est votre nombre d'année d'expérience dans votre entreprise actuelle ?
            'freelance_tjm',//,Quelle est votre TJM en euro ?
            'freelance_average_work_day',//,Quel est votre nombre de jours travaillé en moyenne dans l’année ?
            'contract_work_duration',//,Quelle est votre durée de travail contractuelle ?
            '',//,"Quel est votre ""Statut professionnel"" (indiqué sur votre dernière feuille de paie)"
            '',//,"Quel est votre ""Coefficient"" (indiqué sur votre dernière feuille de paie)"
            'company_department', //,Quel est votre département de travail ?,
            'company_type',//Dans quel type d'entreprise travaillez-vous ?,
            'company_size', //Taille de votre entreprise,
            'job_interest', //Quels sont les aspects les plus importants dans votre emploi actuel ?
            'company_origin', //,"Si elle n'est pas française, quelle est l'origine de votre entreprise ou maison mère ?"
            'other_language', //,"Développez-vous dans d'autres langages que PHP ? Si oui, quel est le principal ?"
            'remote_usage', //,Travaillez-vous en télétravail ?,
            'remote_money',//Prise en charge des frais lié au télétravail,
            'remote_pace', //Quel serait le rythme idéal en télétravail pour vous ? (en nombre de jour par semaine),
            'number_meetup_participation', //À combien d'événement / meetup tech avez-vous participé sur la dernière année ?,
            'technological_watch', //Faites-vous régulièrement de la veille technique ?,
            'os_developpment', //Sous quel OS développez-vous principalement ?,
            'work_method', //Quelle est votre méthode de travail habituelle ?,
            'speciality', //Quelle est votre plus grande spécialité ?,
            'php_version', //Quelle version de PHP utilisez-vous au quotidien ?,
            'cms_usage_in_project', //Utilisez-vous un CMS dans votre/vos projet(s) courant?,
            'has_certification', //Possédez-vous une ou plusieurs certifications PHP ?,
            'certification_list', //"Si oui, merci d'indiquer lesquelles",
            'php_strength', //"D'après vous, quelle est la plus grande force de PHP ?"
            'has_formation', //,Avez-vous suivi une formation au cours de ces deux dernières années ?,
            'formation_subject', //Sur quel(s) sujet(s) avez-vous été formés ?,
            'formation_impact', //Cela a-t-il eu une incidence sur votre emploi/rémunération ?,
            'covid19_company_trust', //"Suite au COVID-19, quel est votre niveau de confiance dans la santé de votre entreprise ?",
            'covid19_company_handle', //Comment trouvez-vous que votre entreprise a géré la crise du COVID-19 ?
            'covid19_future_plan', //,Le COVID-19 a-t-il modifié vos projets de changement d'emploi ?,
            'covid19_salary_impact', //Pensez-vous que le COVID-19 va avoir un impact négatif sur votre progression salariale ?,
            'covid19_work_condition', //"Est-ce que les aménagements des conditions de travail mis en place lors de la pandémie ont été conservés (télétravail complet, ...)",
            'gender', //Vous êtes
        ];
    }
}
