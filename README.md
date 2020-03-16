# Remote

## Start project

- Change the Apache UID (APACHE_UID) and GID (APACHE_GID) arguments in the docker-compose.yml file
- Start services with the 'docker-compose up -d' command
- Enter the www directory and run the database migration with the 'php artisan migrate:fresh --seed' command

