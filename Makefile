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

## clean		Clean all local env
clean: stop
	@echo -e "\n> Clean";
	@docker-compose -f ./wp/docker-compose.yaml rm -v --stop --force && \
		docker volume rm -f wp_db_data && \
		sudo rm -rf ./wp/wp-data;

## start		Start the WordPress and related web apps (phpMyAdmin)
start:
	@echo -e "\n> Start WordPress";
	@docker-compose -f ./wp/docker-compose.yaml up --detach;
	@echo -e "- Waiting for WordPress to start"
	@until $$(curl -sIL http://localhost:8080 | grep -q 'HTTP/1.1 200 OK'); do (echo "Waiting..."; sleep 10s); done;
	@echo -e "- Chown wp-data volume permissions"
	@sudo chown -R $$(id -g):$$(id -u) ./wp/wp-data && \
		mkdir -p wp/wp-data/wp-content/upgrade;

## config 	Configure and install all the plugins, themes etc in the WordPress
##		Vars:
##			file: Path to the wp config file, for example '../config/wp-demo.yaml'
##          		mode: Execution mode. Must be one of: ['all', 'wp', 'local']
##		Example: $ make config file=../config/wp-demo.yaml mode=all
##              	Note: WordPress must be installed and running
config: start
	@echo -e "\n> Configure and install WordPress plugins and themes";
	@cd wp && ./wp-config --file=$(file) --mode=$(mode)

## stop		Stop the WordPress and related web apps (phpMyAdmin)
stop:
	@echo -e "\n> Stop WordPress";
	@docker-compose -f ./wp/docker-compose.yaml stop;

##
## # Developing tasks -----------------------------------------------
##

## pre-commit	Execute pre-commit hooks
pre-commit:
	@echo -e "\n> Execute pre-commit";
	pre-commit run --all-files;
