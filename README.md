# wp-local-dev

## Description

The main purpose of this project 'wp-local-dev' is to provide a local development environment of WordPress CMS to allow definition and developing of websites, themes and plugins, using the following core tecnologies: docker, docker-compose, WP CLI command line tool and python.

Also, a set of python scripts are created, packaged as command line tools, that provides extra functionality to help in environment creation and managing:

- '/wp/wp-config': Command line tool that will install a set of WordPress or local themes and plugins in a clean installed WordPress, using a WP config file and the WP CLI command tool. Also you can set if you want to install the published WP resources, local or both.
- '/wp/wp-backup': Command line tool that will create and restore full backups of the WordPress CMS local environments, so you can switch between one full WP local environment to another, and continue with your work.

All the project management and tasks can be done calling Makefile targets.

### Useful links

- https://developer.wordpress.com/2022/11/14/seetup-local-development-environment-for-wordpress/
- https://github.com/kassambara/wordpress-docker-compose

### Required installed commands

- docker: ver. 24.0.7+
- docker-compose: ver. 1.29.2+
- python: ver. 3.10.12+
- pre-commit (not required for local WP developing): ver. 3.5.0+
- php (only for pre-commit task): ver. 4.1.2+

## Project management & tasks

### Makefile

To know all the Makefile targets, you need to simply execute the `make` command:

```bash
$ make
Makefile project tasks:

	 # Help task ------------------------------------------------------

	 help		Print project tasks help
...
```

In the 'Workflows' section, you can see the most common commands and workflows.

### Project folders

The project has 5 main folders:

- '/.github': Folder for the GitHub CI/CD pipelines.
- '/backup': Folder for the WP locale environment files, outcome of the '/wp/wp-backup' command line.
- '/config': Folder for the WP config files to execute with the '/wp/wp-config' command line. An example of WP config file '/config/wp-demo.yaml' is provided and a documentation of their format in the 'WP config file format' section.
- '/local': Folder for the local development of WP themes and plugins. A demo themes '/local/themes/demo' and plugins '/local/plugins/demo' are included as an example. The local themes and plugins are published using the '/wp/wp-config' command line with the correct WP config file.
- '/wp': Main folder of the local docker WordPress environment, including: main docker-compose file and .env files, python scripts, docker mounted volumes like '/wp/wp-data', etc.

### Workflows

1. Start and install a fresh new local environment WordPress using a WordPres config file:

```bash
# Start a fresh new WordPress
$ make start
...
# Go to http://localhost:8080/wp-admin and install WordPress
...
# Install themes and plugins from WordPress config file
$ make config file=../config/wp-demo.yaml mode=all
...
WP Config updater (ver. 1.0)
- WP config file: ../config/wp-demo.yaml
- Mode: all
- WP CLI commands: '[ pre: 1, wp_themes: 1, wp_plugins: 38, local_themes: 1, local_plugins: 1, post: 0]'
...
# Navigate to http://localhost:8080, check, configure, etc
# Stop the WordPress
$ make stop
...
```

1. Start and stop the local WordPress environment:

```bash
$ make start
...
# Navigate to http://localhost:8080, check, configure, etc
$ make stop
...
```

1. Clean current local WordPress environment and start form scratch:

```bash
$ make clean
...
$ make start
...
# Install themes and plugins, etc ...
$ make stop
...
```

### Other commands

1. Get logs from WordPress running container:

```bash
$ cd wp
$ docker-compose logs -f wordpress
...
```

1. Execute a WP CLI command, with the WordPress installed and running, using the 'wp-cli' container:

```bash
$ cd wp
$ docker run -it -v ./wp-data:/var/www/html -w /var/www/html -u $(id -g):$(id -u) -e WORDPRESS_DB_HOST=db -e WORDPRESS_DB_NAME=wordpress -e WORDPRESS_DB_USER=root -e WORDPRESS_DB_PASSWORD=password --network=wp_net --name wp-cli --rm wordpress:cli-2.9.0 /bin/bash
bash-5.1$ wp cli version
WP-CLI 2.9.0
bash-5.1$ wp theme install graceful-blog --version=1.0.0 --activate --debug
...
bash-5.1$ exit
```

### URLs

Once the WordPress local environment is successfully started, the following URLs are accessible:

1. WordPress website: http://localhost:8080

1. WordPress website install and admin: http://localhost:8080/wp-admin

- Login/Password: Setted in the WordPress install process.

1. phpMyAdmin website: http://localhost:8180

- Login/Password: 'root'/ See 'MYSQL_ROOT_PASSWORD' value in '/wp/.env' file.

### WP config file format

The WP config file format is a plain YAML file. For example, taking a look to de demo file '/config/wp-demo.yaml' (see comments):

```yaml
wp_config: # Root of the config file
  wp: # WordPress published themes and plugins
    themes: # Themes
      - id: atozshop # Unique ID of the theme
        ver: 1.0.2 # Version
        activate: false # Activate or not the theme
      ...
    plugins: # Plugins
      - id: akismet # Unique ID of the plugin
        ver: 5.3 # Version
        activate: false # Activate or not the plugin
      ...
  local: # Local WordPress themes and plugins. All referencing the '/local' path
    themes:
      - id: demo
        path: ../local/themes/demo # Local path of the theme
        activate: true
      ...
    plugins:
      - id: demo
        path: ../local/plugins/demo # Local path of the plugin
        activate: true
      ...
```

**Note: Take in account that the WordPress themes and plugins (not local) must be published in the WordPress repos with the correct versions. Also remember that only one theme can be activated in a single WordPress website, so the last theme with 'activate:true' is the one that will be activated.**
