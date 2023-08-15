## Table of Contents

1. [General Info](#general-info)
2. [Technologies](#technologies)
3. [Installation](#installation)

### General Info

---

Reputation test project made with PHP (Laravel Sail with Docker) and Bootstrap 5 for frontend.
I connected to google maps reviews scraper, exported the data in the form of a CSV file for technomania (electronic equipment store) which I later used in my database. The project has a landing page where you enter the domain (in this case https://www.tehnomanija.rs/) after which you get to the dashboard page where you can see the best and worst scores of all locations. The addresses of the locations are in the form of a link, and by clicking on it, you can access a single location where you can see basic data and a chart.

## Technologies

---

A list of technologies used within the project:

-   [Laravel](https://laravel.com/): Version 8.75
-   [Laravel Sail](https://laravel.com/): Version 1.23
-   [Bootstrap](https://getbootstrap.com/): Version 5.0.2
-   [Fontawesome](https://fontawesome.com/): Version 6.4.2
-   [Apexcharts](https://apexcharts.com/): Version 3.41

## Installation

---

A little intro about the installation.

```
$ git clone https://github.com/leka91/reputation-project.git
$ cd reputation-project
$ composer install
$ Create a copy of .env file (cp .env.example .env)
$ php artisan key:generate - create app encryption key
$ Create an empty database for project using the database tools you prefer
$ In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database
$ ./vendor/bin/sail up - to start local development server
$ ./vendor/bin/sail artisan migrate - to migrate database tables
$ ./vendor/bin/sail artisan db:seed - to fill tables with data
$ ./vendor/bin/sail artisan calculate:scores - script to calculate reputation scores

```
