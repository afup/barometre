.PHONY: vendors data_dirs cs-fix php-build php-shell php-serve node-shell assets-watch

CURRENT_UID ?= $(shell id -u)
CURRENT_GID ?= $(shell id -g)
export CURRENT_UID CURRENT_GID

PHP = docker compose run --rm php
NODE = docker compose run --rm node

init: docker-up php-build
	make vendors
	$(NODE) node_modules/grunt-cli/bin/grunt
	$(PHP) php bin/console doctrine:schema:update --force --complete
	$(PHP) php -d "memory_limit=-1" bin/console doctrine:fixtures:load --no-interaction

php-build:
	docker compose build php

php-shell:
	$(PHP) bash

php-serve: docker-compose.override.yml
	docker compose run --rm --service-ports php symfony server:start --no-tls --allow-all-ip --port=8000

vendors: node_modules vendor

vendor:
	$(PHP) composer install

node_modules: docker/data/npm
	$(NODE) npm install

asset_install:
	$(NODE) node_modules/grunt-cli/bin/grunt

assets-watch:
	$(NODE) node_modules/grunt-cli/bin/grunt watch

node-shell:
	$(NODE) bash

docker-up: data_dirs
	docker compose up -d db

data_dirs: docker/data docker/data/composer docker/data/npm

docker/data:
	mkdir -p docker/data

docker/data/composer: docker/data
	mkdir -p docker/data/composer

docker/data/npm: docker/data
	mkdir -p docker/data/npm

docker-compose.override.yml:
	cp docker-compose.override.yml-dist docker-compose.override.yml

cs-fix:
	docker run --rm -it -w=/app -v ${PWD}:/app oskarstark/php-cs-fixer-ga:latest

deploy: node_modules asset_install
	php bin/console doctrine:migrations:migrate --env=prod --no-interaction
