*campagne*

* id
* nom
* date_debut
* date_fin

*reponse*

* id
* campagne_id
* salaire_annuel_brut
* salaire_annuel_variable
* salaire_satisfaction (1 à 5)
* statut (enum) -> (CDI / CDD / Freelance - entreprise individuelle / Sans emploi / Autre)
* formation_initiale (enum) (Autodidacte / Bac / BTS - DUT - DEUST ou equivalent / Licence ou équivalent / Niveau Master 2 ou ingénieur / Autre)
* entreprise_type (enum) (Editeur / Presse, média / SSII, conseil / Agence de communication / Service informatique d'un client final / Startup / Editeur de logiciel / Autre)
* entreprise_taille (enum) (Freelance ou entreprise individuelle / De 2 à 9 salariés / De 10 à 49 salariés / De 50 à 199 salariés / De 200 à 499 salariés / De 500 à 999 salariés / Plus de 1000 salariés)
* entreprise_departement
* poste_titre (enum) (Directeur, cadre dirigeant / Cadre intermédiaire, responsable d'équipe / Chef de projet / Lead développeur / Architecte / Consultant / Formateur / Développeur / Autre)
* poste_interet (enum) (La rémunération / L'intérêt technique de vos projets / L'ambiance dans l'entreprise / La qualité de vie autour de votre emploi / Autre)
* php_version (enum) (PHP 5.5 / PHP 5.4 / PHP 5.3 / PHP 5.2 / PHP 4)
* php_force (enum) (Son écosystème (outils, frameworks, documentation) / Le nombre de développeurs et de sociétés l'utilisant / La qualité des développeurs sur le marché / Sa performance / Sa facilité d'utilisation)
* formation (bool)
* formation_salaire (bool)
* created_at

*reponse_has_specialite*

* id
* reponse_id
* certification_id

*specialite*

* id
* specialite

(Zend Framework / Symfony / CakePHP / Drupal / eZ Publish / Joomla / Wordpress / Magento / Prestashop / Framework propriétaire / Silex / Yii Framework / Laravel / Code Igniter / SPIP / Kohana / Jelix)

*reponse_has_certification*

* id
* reponse_id
* certification_id

*certification*

* id
* certification

(PHP5, Symfony, Zend Framework, eZ Publish)