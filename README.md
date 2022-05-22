<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Installation
This project was made on Laravel 8 version:

Alternative installation is possible without local dependencies relying on Docker.

Clone the repository:
<ul>
    <li>git clone https://github.com/paulinskiz/students_projects.git</li>
</ul>

Switch to the repo folder:
<ul>
    <li>cd students_projects</li>
</ul>

Install all the dependencies using composer:
<ul>
    <li>composer install</li>
</ul>

Run the database migrations (Make sure that have database named "students_projects"):
<ul>
    <li>php artisan migrate</li>
</ul>

Start the local development server

php artisan serve
You can now access the server at http://localhost:8000

TL;DR command list

git clone https://github.com/paulinskiz/students_projects.git
cd cd students_projects
composer install
Make sure you set the correct database connection information before running the migrations Environment variables

php artisan migrate
php artisan serve