<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h2>About project</h2>

<stong>There is an application for a teacher to assign students to groups for a project.</strong>

Functionality:
1. On firs visit a teacher can see all created projects and ability to  create a new project by providing a title of the project and a number of groups that will participate in the project and a maximum number of students per group. Groups are automatically initialized when a project is created.
2. A teacher can add students to a exact project using the “Add new student” button. Each student must have a unique full name.
3. All students added to a project are visible on a list.
4. Teacher can delete a student. In such a case, the student should be removed from the project.
5. Teacher can unsign a student. In such a case, the student should be removed from the group.
6. Teacher can assign a student to any of the groups. Any student can only be assigned to
a single group. In case the group is full, information text should be visible to a teacher.

<h2>Installation</h2>
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

TL;DR command list:

<ul>
    <li>git clone https://github.com/paulinskiz/students_projects.git</li>
    <li>cd cd students_projects</li>
    <li>composer install</li>
    Make sure you set the correct database connection information before running the migrations Environment variables
    <li>php artisan migrate</li>
    <li>php artisan serve</li>
</ul>