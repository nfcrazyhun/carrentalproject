
## Installation
## Quick Start: Clone this repository and install the dependencies.

```
$ git clone https://github.com/nfcrazyhun/carrentalproject carrent1
$ cd carrent1
$ composer install
$ composer u -o
```
### Create a database for the app

name: car_rental_db

encode: utf8mb4_unicode_ci

### Set up virtual host (eg. with Wampserver),

ServerName :  carrent1

Directory :  c:/wamp64/www/carrent1/web

### Set up tables and demo records
```
$ php yii migrate
```
### The application comes with default admin:

-   username: teszt1
-   password: teszt1


## Note

The project made with the following verions:
- PHP 7.3.8
- MySQL 8.0.17
- Yii 2.0.24 (Framework)

#### If notice notice any problem during installation please follow the detailed official guide [Link below]

-   The minimum required PHP version of Yii is PHP 5.4.
-   It works best with PHP 7.
-   [Follow the Definitive Guide](https://www.yiiframework.com/doc-2.0/guide-start-installation.html)  in order to get step by step instructions.