# Welcome to Belvo Interview Challenge

Hi! This is the Belvo Solution Engineer Case Challenge. The main goal of this Project is to navigate through Belvo API, so, it's a small web app where you can register a new user and start using the **Belvo Connect Widget** to link your user to a couple of institutions, using Belvo Sandbox Environment *(so, not real life institution linking or real life customer data are passing through the integration)*. By navigating through your links, you will be able to check plenty of information like accounts, transactions, balances and more.
By following these steps you should be able to run locally the entire project in your **localhost:8000**
If you have any questions, please email me at rafaelweffort@gmail.com


## Tech stack

This project is using Docker to mount the following containers:

 - An **app** service running PHP7.4-FPM, where the frontend and backend are located;
 - A **db** service running MySQL 5.7, a database mainly to store users and links related to them;
 - An **nginx** service that uses the app service to parse PHP code, before delivering the Laravel application to the end user.

## Pre-requisites

 1. Access to a local Linux (I tried on a Ubunto 22.04) or Mac (I also tried this steps in a MacOS Mojave) or a development server as a non-root user with sudo command privileges. *I haven't tried on a Windows machine.* 
 2. **Docker installed on your machine**, as instructed in [Steps 1 and 2 of the How to Install and Use Docker on Ubuntu tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04).
 3. **Docker Compose installed on your machine**, as instructed in [Step 1 of the How to Install Docker Compose on Ubuntu 18.04 tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-22-04).

## Steps

 1. `Git clone` this project to your local drive
 2.  Access the newly created folder.
 3. We’ll now use  `docker-compose`  commands to build the application image and run the services we specified in our setup.
Build the  `app`  image with the following command:

$ `docker-compose build app`

This command might take a few minutes to complete.
At the end, you should see something like this:
```
Successfully built fe176ff4702b
Successfully tagged belvo:latest
```

 4. When the build is finished, you can run the environment in background mode with:
 
 $ `docker-compose up -d`
 
 The output should be like:
 ```
Creating belvo-db    ... done
Creating belvo-app   ... done
Creating belvo-nginx ... done
```
 5. (Optional) You can check if the containers are up and running:
 
 $ `docker-compose ps`
 
 The output looks like:
 ```
      Name                    Command              State          Ports        
-------------------------------------------------------------------------------
belvo-app     docker-php-entrypoint php-fpm   Up      9000/tcp            
belvo-db      docker-entrypoint.sh mysqld     Up      3306/tcp, 33060/tcp 
belvo-nginx   nginx -g daemon off;            Up      0.0.0.0:8000->80/tcp
```
 6. (Optional) Check if the php files are copied to the `app` container:

 $ `docker-compose exec app ls -l`
 
 Expected output:
 ```
total 256
-rw-rw-r-- 1 sammy 1001    738 Jan 15 16:46 Dockerfile
-rw-rw-r-- 1 sammy 1001    101 Jan  7 08:05 README.md
drwxrwxr-x 6 sammy 1001   4096 Jan  7 08:05 app
-rwxr-xr-x 1 sammy 1001   1686 Jan  7 08:05 artisan
drwxrwxr-x 3 sammy 1001   4096 Jan  7 08:05 bootstrap
-rw-rw-r-- 1 sammy 1001   1501 Jan  7 08:05 composer.json
-rw-rw-r-- 1 sammy 1001 179071 Jan  7 08:05 composer.lock
drwxrwxr-x 2 sammy 1001   4096 Jan  7 08:05 config
drwxrwxr-x 5 sammy 1001   4096 Jan  7 08:05 database
drwxrwxr-x 4 sammy 1001   4096 Jan 15 16:46 docker-compose
-rw-rw-r-- 1 sammy 1001   1015 Jan 15 16:45 docker-compose.yml
-rw-rw-r-- 1 sammy 1001   1013 Jan  7 08:05 package.json
-rw-rw-r-- 1 sammy 1001   1405 Jan  7 08:05 phpunit.xml
drwxrwxr-x 2 sammy 1001   4096 Jan  7 08:05 public
-rw-rw-r-- 1 sammy 1001    273 Jan  7 08:05 readme.md
drwxrwxr-x 6 sammy 1001   4096 Jan  7 08:05 resources
drwxrwxr-x 2 sammy 1001   4096 Jan  7 08:05 routes
-rw-rw-r-- 1 sammy 1001    563 Jan  7 08:05 server.php
drwxrwxr-x 5 sammy 1001   4096 Jan  7 08:05 storage
drwxrwxr-x 4 sammy 1001   4096 Jan  7 08:05 tests
-rw-rw-r-- 1 sammy 1001    538 Jan  7 08:05 webpack.mix.js
```
 7. We’ll now run `composer install` to install the application dependencies:
 
 $ `docker-compose exec app composer install`
 
 8. The last thing we need to do before testing the application is to generate a unique application key with the `artisan` Laravel command-line tool. This key is used to encrypt user sessions and other sensitive data:
 
 $ `docker-compose exec app php artisan key:generate`
 
 To confirm, we should see:
 ```
Application key set successfully.
```
 9. Now go to your browser and access your server’s domain name or IP address on port 8000:
```
http://server_domain_or_IP:8000 
```
Probably: 
```
http://localhost:8000 
```
