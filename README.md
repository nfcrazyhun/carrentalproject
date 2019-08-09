
## Installation
## Quick Start: Clone this repository and install the dependencies.

```
$ git clone https://github.com/nfcrazyhun/carrentalproject carrent1
$ composer install
$ composer u -o
```
###Create a database for the app

name: car_rental_db

encode: utf8_unicode_ci

###Set up virtual host (eg. with Wampserver),

ServerName :  carrent1

Directory :  c:/wamp64/www/carrent1/web

###then modify the httpd-vhosts.conf:

Example below, details
```
#httpd-vhosts.conf
#carrent1
<VirtualHost *:80>
	ServerName carrent1
	DocumentRoot "c:/wamp64/www/carrent1/web"
	<Directory  "c:/wamp64/www/carrent1/web/">
		# use mod_rewrite for pretty URL support
		RewriteEngine on

		# if $showScriptName is false in UrlManager, do not allow accessing URLs with script name
		RewriteRule ^index.php/ - [L,R=404]

		# If a directory or a file exists, use the request directly
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_FILENAME} !-d

		# Otherwise forward the request to index.php
		RewriteRule . index.php

		# ...other settings...
		#Options +Indexes +Includes +FollowSymLinks +MultiViews
		#AllowOverride All
		#Require local
	</Directory>
</VirtualHost>
```


###Set up tables and demo records
```
$ php yii migrate
```
###The application comes with default admin.

-   username: teszt1
-   password: teszt1


## Note

The project made with the following verions:
- PHP 7.3.8
- MySQL 8.0.17

####If notice notice any problem during installation please follow the detailed official guide [Link below]

-   The minimum required PHP version of Yii is PHP 5.4.
-   It works best with PHP 7.
-   [Follow the Definitive Guide](https://www.yiiframework.com/doc-2.0/guide-start-installation.html)  in order to get step by step instructions.