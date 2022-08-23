<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Getting started

## Installation

Clone the repository

    git clone git@github.com:akitomen/microservices-app-for-weather-data-gathering-laravel-vuejs-docker.git

Switch to the repo folder

    cd microservices-app-for-weather-data-gathering-laravel-vuejs-docker/api

Run your containers

    docker-compose build
    
    docker-compose up -d
        
Switch to the repo folder

    cd backend
    
Install all the dependencies using composer

    docker-compose exec app composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
    DB_DATABASE=apptest
    DB_USERNAME=root
    DB_PASSWORD=root

Generate a new application key

    docker-compose exec app php artisan key:generate

Generate a new JWT authentication secret key

    docker-compose exec app 

Run the database migrations (**Set the database connection in .env before migrating**)

    docker-compose exec app php artisan migrate
   
Run the seed auth
    
    docker-compose exec php artisan db:seed --class=CitySeeder
    
    docker-compose exec php artisan db:seed --class=ApiUserSeeder

You can now access the server at http://localhost:801

API auth
    http://localhost:801/api/documentation
    login: login
    password: password

    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeds/DummyDataSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    