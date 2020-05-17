<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Requerimientos
 - PHP >= 7.2.5
 - NodeJS >= 10.0

## Installation

Install PHP libraries:
- Run: composer install

Install Node libraries:
- Run: npm install

## Configuration
    - Copy .env.example and rename it to .env
    - DB app configuration in .env file
        - DB_DATABASE=laravel
        - DB_USERNAME=root
        - DB_PASSWORD=
    - DB testing configuration in .env file (Also unit test was developt with MySQL)
        - DB_DATABASE_TEST=voxie_contacts_test
        - DB_USERNAME_TEST=root
        - DB_PASSWORD_TEST=

## Migrate DB
Migrate app database
    - Run with 'php artisan migrate'

Migrate unit test database
    - Run with 'php artisan migrate --database=mysql_testing'

## Run
    Run with 'php artisan serve'
    To modify front end 'run npm run dev'