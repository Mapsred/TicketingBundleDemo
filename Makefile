DOCKER_COMPOSE  = docker-compose

EXEC_PHP        = $(DOCKER_COMPOSE) exec -T php-fpm
EXEC_JS         = $(DOCKER_COMPOSE) exec -T nodejs

SYMFONY         = $(EXEC_PHP) php bin/console
COMPOSER        = $(EXEC_PHP) composer
YARN            = $(EXEC_JS) yarn

##
## Project
## -------
##

no-docker:
	$(eval DOCKER_COMPOSE := \#)
	$(eval EXEC_PHP := )
	$(eval EXEC_JS := )

install: ## Install and start the project
install: .env docker-compose build vendor assets db

build:
	$(DOCKER_COMPOSE) up -d --build

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

assets:
	$(SYMFONY) assets:install --symlink

bundle-translation:
	$(SYMFONY) translation:update --dump-messages --force en TicketingBundle --output-format=xlf && \
	$(SYMFONY) translation:update --dump-messages --force fr TicketingBundle --output-format=xlf

.PHONY: no-docker install start stop assets

##
## Utils
## -----
##

db: ## Reset the database and load fixtures
db: .env vendor
	$(SYMFONY) doctrine:database:create --if-not-exists && \
	$(SYMFONY) doctrine:schema:update --force && \
	$(SYMFONY) doctrine:fixtures:load --no-interaction --purge-with-truncate

migration: ## Create a migration
	$(SYMFONY) make:migration

migrate: ## Run the last migration
	$(SYMFONY) doctrine:migrations:migrate

schema-update:
	$(SYMFONY) doctrine:schema:update --force


.PHONY: db migration dump migration migrate

# rules based on files
composer.lock: composer.json
	$(COMPOSER) update --lock --no-scripts --no-interaction

vendor: composer.lock
	$(COMPOSER) install

docker-compose:
	cp docker-compose.yml.dist docker-compose.yml

.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help