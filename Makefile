PWD					?= pwd_unknown
SHELL				:= /bin/bash
THIS_FILE      		:=	$(lastword $(MAKEFILE_LIST))

dc-exec := docker compose exec php

build:
	docker compose up -d --build
	$(dc-exec) composer install

up:
	docker compose up -d

down:
	docker compose down

quality:
	$(dc-exec) php vendor/bin/ecs --fix

count:
	$(dc-exec) php src/main.php $(path)

count-sanitize:
	$(dc-exec) php src/main.php $(path) --sanitize
