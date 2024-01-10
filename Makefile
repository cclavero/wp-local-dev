# Env & Vars --------------------------------------------------------

SHELL := /bin/bash

# Tasks -------------------------------------------------------------

## # Help task ------------------------------------------------------
##

## help		Print project tasks help
help: Makefile
	@echo -e "\n Makefile project tasks:\n";
	@sed -n 's/^##/	/p' $<;
	@echo -e "\n";

##
## # Global tasks ---------------------------------------------------
##

## start		Start the WordPress and related web apps (phpMyAdmin)
start:
	@echo -e "\n> Start WordPress";
	@docker-compose -f ./wp/docker-compose.yaml up --detach;
	@echo -e "- Waiting for WordPress to start"
	@until $$(curl -sIL http://localhost:8080 | grep -qE 'HTTP/1.1 20|HTTP/1.1 50'); do (echo "Waiting..."; sleep 10s); done;

## stop		Stop the WordPress and related web apps (phpMyAdmin)
stop:
	@echo -e "\n> Stop WordPress";
	@docker-compose -f ./wp/docker-compose.yaml stop;

## clean		Clean all local env
clean: stop
	@echo -e "\n> Clean";
	@docker-compose -f ./wp/docker-compose.yaml rm -v --stop --force && \
		docker volume rm -f wp_db_data && \
		sudo rm -rf ./wp/wp-data;

## init		Init local env
init:
	@echo -e "\n> Init";
	@sudo chown -R $$(id -g):$$(id -u) ./wp/wp-data && \
		mkdir -p wp/wp-data/wp-content/upgrade && \
		mkdir -p wp/wp-data/wp-content/uploads && \
		sudo chmod 777 -Rf wp/wp-data/wp-content/uploads;

## config 	Configure and install all the plugins, themes etc in the WordPress
##		Vars:
##			file: Path to the WP config file, for example '../config/wp-demo.yaml'
##          		mode: Execution mode. Must be one of: ['all', 'wp', 'local']
##		Example: $ make config file=../config/wp-demo.yaml mode=all
##              	Note: WordPress must be successfully installed
config: start
	@echo -e "\n> Configure and install WordPress plugins and themes";
	@cd wp && ./wp-config --file=$(file) --mode=$(mode)

## backup		Execute a backup creation on restore of the WordPrass local environment
##      		Vars:
## 			file: Full path of the backup file to create or restore, for example '../backup/web1.zip'
##          		mode: Execution mode. Must be one of: ['create', 'restore']
##		Example: $ make backup file=../backup/web1.zip mode=create
##              	Note: WordPress must be successfully installed
backup: start
	@echo -e "\n> Create or restore a local WordPress backup";
	@cd wp && ./wp-backup --file=$(file) --mode=$(mode)

##
## # Developing tasks -----------------------------------------------
##

## pre-commit	Execute pre-commit hooks
pre-commit:
	@echo -e "\n> Execute pre-commit";
	pre-commit run --all-files;
