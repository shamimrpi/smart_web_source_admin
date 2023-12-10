# Laravel 10.10 Project

This Laravel project is built on version 10.10 and with Livewire. It incorporates jQuery via CDN, custom CSS and JS, Bootstrap 5 via npm, a City model and migration, a Job table migration, a City upload page with Excel file upload, a City list page with state and county search implemented using Livewire without page reload, and pagination without page reload.

## Prerequisites

Ensure the following software is installed on your machine:

- PHP (>= 8.1)
- Composer
- Node.js and npm
- Laravel CLI

## Installation
Welcome to project! Follow the steps below to set up the project.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/shamimrpi/smart_web_source_admin.git

2. Project Directory:
   ```bash
   cd smart_web_source_admin

3. Install Composer:
   ```bash
   composer install

4. Copy the .env.example file to .env and configure your environment variables:
   ```bash
   cp .env.example .env

5. Generate the application key:
  ```bash
   php artisan key:generate

6. Go to mysql create database and open .env file write database name

7. Run migration the database:
  ```bash
   php artisan migrate

8. Run command::
  ```bash
   php artisan serve

9. another terminal Run command npm:
   ```bash
   npm run dev

10. Successfully Project run
