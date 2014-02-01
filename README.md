Baromètre
=========

Lors du forum PHP 2013 l’Association Française des Utilisateurs de PHP (AFUP) et le cabinet de recrutement spécialisé Agence-e ont publié le résultat d'une enquête auprès des développeurs PHP : [le baromètre AFUP – Agence-e 2014](http://afup.org/docs/barometre/Barometre-AFUP-Agence-e-2014-Les-salaires-de-l-ecosysteme-PHP-en-France.pdf) présentant la rémunération des développeurs PHP ainsi que l’écosystème PHP en France.

Ce site à pour vocation de présenter les résultats de cette enquête en permettant de filtrer sur différents critères (le département, la rémunération, le type d'entreprise...) pour ainsi présenter des résultats plus en accord avec la situation du développeur les consultant.


Dépendances
-----------

* [bower](http://bower.io/)
* [grunt](http://gruntjs.com/)
* [sass](http://sass-lang.com/)

Installation
------------

```
php composer.phar install
bower install
npm install
```

Build des assets
----------------

```
grunt
```

Pour les builder automatiquement à chaque modification :

```
grunt watch
```

Construction de la base de donnée
---------------------------------

```
php app/console doctrine:schema:update --force
```

Chargement des données de test
------------------------------

Pour charger les données de test, il faut effectuer un

```
php app/console doctrine:fixtures:load --fixtures=src/Afup/BarometreBundle/DataFixtures/ORM --fixtures=src/Afup/BarometreBundle/DataTest/ORM/
```

ou

```
php app/console doctrine:fixtures:load --append --fixtures=src/Afup/BarometreBundle/DataTest/ORM/
```
si  un ```php app/console doctrine:fixtures:load ``` a déjà été effectué.
