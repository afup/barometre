<?php


namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PressReviewController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render(
            'AfupBarometreBundle:PressReview:index.html.twig',
            ['press_review_by_year' => $this->prepareReviews($this->getPressReviews())]
        );
    }

    /**
     * @param array $reviews
     *
     * @return array
     */
    protected function prepareReviews(array $reviews)
    {
        $reviewsByYear = [];
        foreach ($reviews as &$review) {
            $date = new \DateTime($review['date']);
            $review['date'] = $date;
            $reviewsByYear[$date->format('Y')][] = $review;
        }

        krsort($reviewsByYear);

        foreach ($reviewsByYear as &$reviews) {
            usort($reviews, function ($reviewA, $reviewB) {
                return $reviewA['date'] < $reviewB['date'] ? 1 : -1;
            });
        }

        return $reviewsByYear;
    }

    /**
     * @return array
     */
    protected function getPressReviews()
    {
        //@codingStandardsIgnoreStart
        return [
            [
                'url' => 'http://www.clubic.com/pro/emploi-informatique/actualite-739143-afup-barometre-php-salaire-developpeur-secteur.html',
                'title' => 'Développeur PHP : quelles perspectives de salaire ?',
                'media_logo' => 'clubic.png',
                'date' => '2014-11-14',
            ],
            [
                'url' => 'http://blog.humancoders.com/lancement-de-lenquete-2016-barometre-salaires-afup-human-coders-1664/',
                'title' => 'Lancement de l’enquête 2016 du baromètre des salaires AFUP/Human Coders',
                'media_logo' => 'human_coders.png',
                'date' => '2016-06-23',
            ],
            [
                'url' => 'http://www.jebossedansleweb.com/salaires-developpeurs-2015/',
                'title' => 'Baromètre : salaires des développeurs en 2015',
                'media_logo' => 'je-bosse-dans-le-web.jpg',
                'date' => '2016-01-08',
            ],
            [
                'url' => 'http://www.journaldunet.com/web-tech/developpeur/1170666-les-salaires-des-developpeurs-php-en-2015/',
                'title' => 'Les salaires des développeurs PHP en 2015',
                'media_logo' => 'jdn.svg',
                'date' => '2016-01-11',
            ],
            [
                'url' => 'http://www.journaldunet.com/developpeur/php/salaire-du-developpeur-php-2014/',
                'title' => 'Les salaires des développeurs PHP par profil et ancienneté',
                'media_logo' => 'jdn.svg',
                'date' => '2013-11-21',
            ],
            [
                'url' => 'http://www.clubic.com/pro/emploi-informatique/actualite-602350-developpeur-php-salaire-metier-perspective-satisfaction-etude-afup.html',
                'title' => 'PHP : quels sont les salaires du secteur en France ?',
                'media_logo' => 'clubic.png',
                'date' => '2013-11-21',
            ],
            [
                'url' => 'http://www.programmez.com/actualites/le-salaire-des-developpeurs-php-en-france-21598',
                'title' => 'Le salaire des développeurs PHP en France',
                'media_logo' => 'programmez.png',
                'date' => '2014-11-03',
            ],
            [
                'url' => 'http://blog.humancoders.com/les-salaires-des-developpeurs-en-2015-1552/',
                'title' => 'Les salaires des développeurs en 2015 (Baromètre AFUP – Human Coders)',
                'media_logo' => 'human_coders.png',
                'date' => '2016-01-12',
            ],
            [
                'url' => 'http://www.silicon.fr/salaires-developpeurs-php-afup-humancoders-135682.html',
                'title' => 'Les salaires des développeurs PHP en hausse en 2015',
                'media_logo' => 'silicon.png',
                'date' => '2016-01-13',
            ],
            [
                'url' => 'http://www.lemondeinformatique.fr/actualites/lire-agence-e-publie-un-barometre-sur-les-salaires-des-developpeurs-php-avec-l-afup-55891.html',
                'title' => 'Agence-e publie un baromètre sur les salaires des développeurs PHP avec l\'Afup',
                'media_logo' => 'le_monde_informatique.png',
                'date' => '2013-12-05'
            ],
            [
                'url' => 'http://www.developpez.com/actu/76854/Quels-sont-les-salaires-des-developpeurs-PHP-en-France-L-AFUP-publie-son-barometre/',
                'title' => 'Quels sont les salaires des développeurs PHP en France ?',
                'media_logo' => 'developpez.jpg',
                'date' => '2014-11-03',
            ],
            [
                'url' => 'http://www.presse-citron.net/quels-salaires-pour-les-developpeurs-en-2015/',
                'title' => 'Quels salaires pour les développeurs en 2015 ?',
                'media_logo' => 'presse-citron.png',
                'date' => '2016-01-13',
            ],
            [
                'url' => 'http://www.e-works.fr/blog/grille-salaire-developpeurs-php-france-2016/',
                'title' => 'Grille de salaire des développeurs PHP en France en 2016',
                'media_logo' => 'eworks.jpg',
                'date' => '2016-01-20',
            ],
            [
                'url' => 'http://www.toolinux.com/Developpeurs-le-barometre-des',
                'title' => 'Développeurs : le baromètre des salaires 2015 est connu',
                'media_logo' => 'toolinux.png',
                'date' => '2016-01-18',
            ],
            [
                'url' => 'https://www.maddyness.com/business/2016/02/02/infographie-le-salaire-des-developpeurs-francais/',
                'title' => 'Salaire, spécialité, type de contrat : quel est le profil type du développeur français ?',
                'media_logo' => 'maddyness.svg',
                'date' => '2016-02-02'
            ],
            [
                'url' => 'http://www.agence-e.fr/component/content/article/11-sondages/39-barometre-afup-les-salaires-du-php-en-france-2014',
                'title' => 'Baromètre AFUP - Agence-e 2015 : les salaires du PHP en France',
                'media_logo' => 'agence-e.png',
                'date' => '2014-10-27'
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/945/edition-2016-du-barometre-des-salaires-en-php',
                'title' => 'C\'est parti pour l\'édition 2016 du baromètre des salaires en PHP',
                'media_logo' => 'afup.png',
                'date' => '2016-06-01',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/935/le-barometre-des-salaires-devoile-ses-resultats',
                'title' => 'Le baromètre des salaires 2015 dévoile ses résultats',
                'media_logo' => 'afup.png',
                'date' => '2016-01-12',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/906/vos-collegues-ont-ils-repondu-au-barometre-des-salaires',
                'title' => 'Vos collègues ont-ils répondu au baromètre des salaires 2015 ?',
                'media_logo' => 'afup.png',
                'date' => '2015-05-29',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/871/barometre-des-salaires-3-en-collaboration-avec-human-coders',
                'title' => 'Baromètre des salaires #3, en collaboration avec Human Coders',
                'media_logo' => 'afup.png',
                'date' => '2015-02-16',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/849/consultez-le-barometre-des-salaires-php',
                'title' => 'Consultez le baromètre des salaires PHP 2014',
                'media_logo' => 'afup.png',
                'date' => '2014-11-20',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/846/les-resultats-du-barometre-des-salaires-en-exclusivite-au-forum',
                'title' => 'Les résultats du baromètre des salaires PHP 2014 en exclusivité au Forum PHP 2014',
                'media_logo' => 'afup.png',
                'date' => '2014-10-21',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/774/le-barometre-des-salaires-contre-attaque',
                'title' => 'Le baromètre des salaires contre-attaque !',
                'media_logo' => 'afup.png',
                'date' => '2014-05-02',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/744/impliquez-vous-dans-le-projet-du-barometre-des-salaires',
                'title' => 'Impliquez-vous dans le projet du baromètre des salaires',
                'media_logo' => 'afup.png',
                'date' => '2014-05-02',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/732/le-barometre-des-salaires-en-php-a-rendu-son-verdict',
                'title' => 'Le baromètre des salaires en PHP a rendu son verdict',
                'media_logo' => 'afup.png',
                'date' => '2013-11-22',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/731/version-php-barometre',
                'title' => 'Baromètre PHP : un premier résultat sur la répartition des versions de PHP utilisées',
                'media_logo' => 'afup.png',
                'date' => '2013-11-16',
            ],
            [
                'url' => 'http://afup.org/pages/site/?route=actualites/700/lafup-et-lagence-e-lancent-un-barometre-des-salaires',
                'title' => 'L\'AFUP et l\'Agence-E lancent un baromètre des salaires',
                'media_logo' => 'afup.png',
                'date' => '2013-07-11',
            ],
            [
                'url' => 'http://www.toolinux.com/Participez-au-barometre-du-salaire',
                'title' => 'Participez au baromètre du salaire des développeurs 2015',
                'media_logo' => 'toolinux.png',
                'date' => '2015-06-19',
            ],
            [
                'url' => 'http://www.frenchweb.fr/insiders-les-developpeurs-sont-ils-satisfaits-de-leur-salaire/222781',
                'title' => '[INSIDERS] Les développeurs sont-ils satisfaits de leur salaire?',
                'media_logo' => 'frenchweb.jpg',
                'date' => '2016-01-13',
            ],
            [
                'url' => 'http://www.journaldunet.com/web-tech/developpeur/1170666-les-salaires-des-developpeurs-php-en-2016/',
                'title' => 'Les salaires des développeurs PHP en 2016',
                'media_logo' => 'jdn.svg',
                'date' => '2016-10-28',
            ],
            [
                'url' => 'http://www.silicon.fr/salaires-developpeurs-php-2016-afup-162024.html',
                'title' => 'Salaires : des disparités entre développeurs PHP en 2016',
                'media_logo' => 'silicon.png',
                'date' => '2016-11-07',
            ],
            [
                'url' => 'https://afup.org/news/977-nouvelle-edition-du-barometre',
                'title' => 'Nouvelle édition du baromètre des salaires en PHP !',
                'media_logo' => 'afup.png',
                'date' => '2017-10-24',
            ],
            [
                'url' => 'https://blog.humancoders.com/contribuez-barometre-salaires-2017-de-lafup-2264/',
                'title' => 'Contribuez au baromètre des salaires 2017 de l’AFUP !',
                'media_logo' => 'human_coders.png',
                'date' => '2017-11-14',
            ],
            [
                'url' => 'https://www.programmez.com/actualites/lenquete-2017-du-barometre-des-salaires-en-php-est-ouverte-26824',
                'title' => 'L\'enquête 2017 du baromètre des salaires en PHP est ouverte',
                'media_logo' => 'programmez.png',
                'date' => '2017-11-28',
            ],
            [
                'url' => 'http://www.toolinux.com/Participez-a-l-enquete-2017-du',
                'title' => 'Le baromètre des salaires PHP relancé',
                'media_logo' => 'toolinux.png',
                'date' => '2017-12-14',
            ],
        ];
        //@codingStandardsIgnoreEnd
    }
}
