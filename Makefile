.PHONY: vendors data_dirs cs-fix

CURRENT_UID ?= $(shell id -u)

init:
	docker-compose run --rm cli /bin/bash -l -c "make vendors"
	docker-compose run --rm cli /bin/bash -l -c "./node_modules/grunt-cli/bin/grunt"
	docker-compose run --rm cli /bin/bash -l -c "php bin/console doctrine:schema:update --force"
	docker-compose run --rm cli /bin/bash -l -c "php -d "memory_limit=-1" bin/console doctrine:fixtures:load --no-interaction"

vendors: node_modules vendor

vendor:
	composer install

node_modules:
	npm install

asset_install:
	node_modules/grunt-cli/bin/grunt

docker-up: var/logs/.docker-build data_dirs
	docker-compose up

docker-build: var/logs/.docker-build

var/logs/.docker-build: docker-compose.yml docker-compose.override.yml $(shell find docker/dockerfiles -type f)
	docker-compose rm --force
	CURRENT_UID=$(CURRENT_UID) docker-compose build
	touch var/logs/.docker-build

data_dirs: docker/data docker/data/composer

docker/data:
	mkdir -p docker/data

docker/data/composer: docker/data
	mkdir -p docker/data/composer

docker-compose.override.yml:
	cp docker-compose.override.yml-dist docker-compose.override.yml

cs-fix:
	docker run --rm -it -w=/app -v ${PWD}:/app oskarstark/php-cs-fixer-ga:latest

deploy: node_modules asset_install
	php bin/console doctrine:migrations:migrate --env=prod --no-interaction
