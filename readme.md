### Sprint 8/ PP8

## Content management system- PHP ORM / DOCTRINE

## How to launch

- Download [XAMPP](https://www.apachefriends.org/index.html) and install it.
- Download [MySQL Workbench](https://www.mysql.com/products/workbench/) and install it.
- Download or clone git repository BIT_PP8 and place it inside htdocs directory (XAMPP).
- Run XAMPP and start Apache and MySQL server.
- Open MySQL workbench and create a server with these settings:

```sh
Server name : localhost
Username : root
There is no password so leave it blank. If you add password please config bootstrap.php accordingly.
```

- Open MySQL workbench and import code to create database with structure (code provided with sql file).
- Install composer (installation instructions: [Composer](https://getcomposer.org/download)) and in the terminal:
  -if composer is installed locally in console type in: php 'path to composer.phar file'/composer.phar install
  -if composer is installed on your system globally in console type in: composer install
- Open your browser and in the searchbar type in:

```sh
localhost/BIT_PP8
```

- Database with empty tables will be created on launch or you can launch MySQL Workbench before opening project and run SQL file provided (creates database with tables and data).
- Make sure that server details inside bootstrap.php file (servername, username, password) match with created server, otherwise you won't be able to launch the project.
- Add, remove, update pages at will.

## How to use

- Setup your MySQL server and launch project.
- User basic rights:
  - You can can view pages from base page as user.
- Admin rights:
- Go to localhost/bit_pp8/admin to access login page. (Login details are on the login page)
- Once logged in you can see admin panel where you can create, update, delete pages.
  - Adding/updating pages accept html code , meaning you will see you desired page from user.

```diff
 When updating projects to use multiselect press and hold CTRL button and left-click on names you want to add or remove from project.
 For Apple users press press and hold CMD button and left-click on names.
```

## Project tasks

- Create working content management system using PHP ORM and Doctrine.
- Display pages for user from MySQL server.
- Create admin panel.
- Create Add new page form.
- Create Delete page functionality.
- Create Update page form.
- Upload to github.
- Keep the code clean - structure ,validity, website, github.
- Create readme.md.

## Project workflow

- 1.Layout creation using CSS , database.php file creation.
- 2.Added working ADD forms for admin panel.
- 3.Added working Delete buttons for admin panel.
- 3.Added working Update forms for admin panel.
- 4.Added readme.

---

Uploaded to github to satisfy condtional commits.

---

## Goal

To create simple Content Management System using PHP ORM and Doctrine.

## About The Project

Learning project: PHP ORM / Doctrine.
Project is done using PHP ORM , Doctrine , CSS.
