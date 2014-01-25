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
* statut (enum)
* formation_initiale (enum)
* entreprise_type (enum)
* entreprise_taille (enum)
* entreprise_departement
* poste_interet (enum)
* php_version (enum)
* php_force (enum)
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

*reponse_has_certification*

* id
* reponse_id
* certification_id

*certification*

* id
* certification

