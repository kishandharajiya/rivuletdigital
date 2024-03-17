# Task Management System

## Overview

This project implements a secure task management system with role-based access control using OAuth2 authentication. It allows users to manage tasks with distinct roles: Admin, Manager, and Employee. Each role has specific permissions and capabilities within the application.

## Features

-   Secure login and logout functionality using OAuth2 authentication.
-   Distinct roles (Admin, Manager, Employee) with specific permissions.
-   Task CRUD operations with attributes such as title, description, due date, and status.
-   Real-time notifications for task updates using Laravel Echo and WebSockets.
-   Email notifications for task assignments using Laravel Job and Queue functionality.

## Role-based Permissions

-   **Admin:** Full control over the application including task and user management.
-   **Manager:** Authorization to manage tasks and assign tasks to users, excluding user management.
-   **Employee (User):** Can manage their own tasks, view and update task status and description only.

## Implementation Steps

1. **Project Setup:** Initialize a new Laravel project setup.
2. **Custom Routes:** Implement a custom route file and bind it to the `web.php` routes file.
3. **Database Setup:** Use migrations to create database tables and Seeder data for all modules.
4. **Authentication:** Implement user authentication and role-based authorization.
5. **Models and Controllers:** Create relevant models, controllers, and other necessary components. Define relationships between models.
6. **Blade Layout:** Implement a basic layout for Blade files.
7. **Validation:** Utilize Laravel's built-in validation for data validation before storage.

## Installation

1. Clone the repository.
2. Laravel Version `9.19` PHP Version `8.1.5` Node  version : `18.16.0`  
3. Run `composer install` to install dependencies.
4. Run `npm install` to install node dependencies.
5. Copy `.env.example` to `.env` and configure your environment variables.
6. Run `php artisan key:generate` to generate application key.
7. Run `php artisan migrate` to migrate database tables.
8. Run `php artisan db:seed` to seed the database with initial data.
9. Serve the application using `php artisan serve`.
10. Serve the frontend vite application using `npm run dev`.
11. Command for the Queue request process `php artisan queue:work`.


## Contributors

-   Kishan Dharajiya <kishandharajiya@gmail.com>

