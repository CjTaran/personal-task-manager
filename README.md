# Personal Task Manager

Project Code: WST21-PM-2026-SF
Student Name: [Your Name]
Course & Year: [BSIT 2nd Year]
Database Used: SQLite

## Features
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status

## Overview
This project is a Laravel-based Personal Task Manager that allows users to create, manage, update, and delete tasks with their task names, descriptions, statuses, and due dates.

## Setup Instructions
1. Clone the repository.
2. Run `composer install`.
3. Ensure the database file exists:
   `touch database/database.sqlite`
4. Run migrations:
   `php artisan migrate`
5. Start the Laravel app:
   `php artisan serve`
6. Open `http://localhost:8000` in your browser.

## Project Structure
- `app/Models/Task.php` – task model
- `app/Http/Controllers/TaskController.php` – task CRUD and status logic
- `database/migrations/` – tasks table schema
- `resources/views/tasks/` – Blade templates for the task manager UI
- `routes/web.php` – route definitions

## Notes
This project uses SQLite for a simple local database setup while still meeting the required task manager functionality.
