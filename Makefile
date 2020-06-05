UID=$(shell id -u)
GID=$(shell id -g)
FILE=docker-compose.yml

.PHONY: bash
bash: ## gets inside a php container
	UID=${UID} GID={GID} docker-compose -f ${FILE} exec --user=${UID} php sh

.PHONY: build
build: ## docker-compose build
	UID=${UID} GID={GID} docker-compose -f ${FILE} build

.PHONY: up
up: ## up all containers
	UID=${UID} GID=${GID} docker-compose -f ${FILE} up -d

.PHONY: stop
stop: ## stop all containers
	UID=${UID} GID=${GID} docker-compose -f ${FILE} stop

.PHONY: down
down: ## down all containers
	UID=${UID} GID=${GID} docker-compose -f ${FILE} down
