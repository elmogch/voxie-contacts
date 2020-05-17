# Voxie Contacts

## Requirements
 - PHP >= 7.2.5
 - NodeJS >= 10.0

## Installation

Install PHP libraries:
- Run: composer install

Install Node libraries:
- Run: npm install

## Configuration
Copy .env.example and rename it to .env

DB app configuration in .env file (MySQL database)
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=

DB testing configuration in .env file (Also unit test is MySQL database)
- DB_DATABASE_TEST=voxie_contacts_test
- DB_USERNAME_TEST=root
- DB_PASSWORD_TEST=

## Migrate DB
Migrate app database
- Run with 'php artisan migrate'

Migrate unit test database
- Run with 'php artisan migrate --database=mysql_testing'

## Run
- Run with 'php artisan serve'
- To modify front end 'run npm run dev'