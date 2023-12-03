# wordpress-local-dev

--- TODO

- https://developer.wordpress.com/2022/11/14/seetup-local-development-environment-for-wordpress/
- https://janakiev.com/blog/python-shell-commands/
- https://stackoverflow.com/questions/27494758/how-do-i-make-a-python-script-executable
- https://github.com/kassambara/wordpress-docker-compose/blob/master/docker-compose.yml

---

- Wordpress: http://localhost:8080
- phpMyAdmin: http://localhost:8180

---
 


 - WP-CLI

https://www.ibm.com/docs/en/mas-cd/maximo-manage/continuous-delivery?topic=deployment-running-docker-image

$ docker run -it -v ./wp-data:/var/www/html -w /var/www/html -e WORDPRESS_DB_HOST=db -e WORDPRESS_DB_NAME=wordpress -e WORDPRESS_DB_USER=root -e WORDPRESS_DB_PASSWORD=password --network=wp_net --name wp-cli --rm wordpress:cli-2.9.0 /bin/bash 
# whoami
www-data
# mariadb -h db -P 3306 -u root --password=password wordpress
#$ SHOW TABLES;
#$ exit;

---

- Tema 'Could not create directory. "/var/www/html/wp-content/upgrade"'

$ mkdir wp/wp-data/wp-content/upgrade
$ ls -la wp/wp-data/wp-content

----

$ docker run -it -v ./wp-data:/var/www/html -w /var/www/html -u $(id -g):$(id -u) -e WORDPRESS_DB_HOST=db -e WORDPRESS_DB_NAME=wordpress -e WORDPRESS_DB_USER=root -e WORDPRESS_DB_PASSWORD=password --network=wp_net --name wp-cli --rm wordpress:cli-2.9.0 /bin/bash
# wp theme install graceful-blog --version=1.0.0 --activate --debug


----

$ docker-compose logs -f wordpress


