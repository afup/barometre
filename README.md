Baromètre
=========


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
