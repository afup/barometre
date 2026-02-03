# Baromètre

[http://barometre.afup.org](http://barometre.afup.org)

[![Build Status](https://secure.travis-ci.org/afup/barometre.png?branch=master)](http://travis-ci.org/afup/barometre)

Lors du forum PHP 2013 l’Association Française des Utilisateurs de PHP (AFUP) et le cabinet de recrutement spécialisé Agence-e ont publié le résultat d'une enquête auprès des développeurs PHP : [le baromètre AFUP – Agence-e 2014](http://afup.org/docs/barometre/Barometre-AFUP-Agence-e-2014-Les-salaires-de-l-ecosysteme-PHP-en-France.pdf) présentant la rémunération des développeurs PHP ainsi que l’écosystème PHP en France.

Ce site a pour vocation de présenter les résultats de cette enquête en permettant de filtrer sur différents critères (le département, la rémunération, le type d'entreprise...) pour ainsi présenter des résultats plus en accord avec la situation du développeur les consultant.

## Installation locale (Symfony CLI + MySQL Docker)

* cloner le dépot
* installer Symfony CLI : https://symfony.com/download
* démarrer MySQL : `make docker-up`
* installer les dépendances et initialiser la base : `make init`

_Le port MySQL exposé est `3399` via `docker-compose.override.yml`._

### Lancer l'application avec Symfony CLI

```
symfony server:start
```

Par défaut, Symfony CLI sert le dossier `public/`. Vous pouvez ensuite accéder au site via l’URL indiquée par la commande.

Commandes utiles :

```
symfony server:stop
symfony server:status
symfony server:log
```

## Installation manuelle

### Dépendances

* node / npm

### Installation

```
php composer.phar install
npm install
```

### Build des assets

#### Si grunt-cli est installé globalement

```
grunt
```

Pour les builder automatiquement à chaque modification :

```
grunt watch
```

#### Si grunt-cli n'est pas installé globalement

```
./node_modules/.bin/grunt
```

Pour les builder automatiquement à chaque modification :

```
./node_modules/.bin/grunt watch
```

#### Si vous avez une erreur `Cannot find module './build/Release/shell'`

Il peut être necessaire de rebuilder execSync. Pour se faire :

1. Une version non 'pre' de node est necessaire
2. Installer node-gyp (globalement : `sudo npm install -g node-gyp`)
3. Se placer dans le bon répertoire `cd node_modules/grunt-favicons/node_modules/execSync`
4. Executer `node-gyp rebuild`

Vous pouvez retourner dans le répertoire racine et relancer la commande grunt.

## Construction de la base de donnée

Création de la base
```
php app/console doctrine:database:create
```

Mise à jour/création du schema
```
php app/console doctrine:schema:update --force
```

## Chargement des données de test

Pour charger les données de test, il faut effectuer un

```
php app/console doctrine:fixtures:load --fixtures=src/Afup/BarometreBundle/DataTest/ORM/
```


## Installation des hooks de précommit

```
grunt githooks
```

## Installation de données réelles

re installation des fixtures

```
php app/console doctrine:fixtures:load
```

chargement des données.

Le séparateur du fichier csv doit être ";".

```
php app/console barometre:imports  2013 01/05/2013 01/11/2013  ~/Downloads/test.csv
```

pour créer une campagne du 01/05/2013 01/11/2013.
