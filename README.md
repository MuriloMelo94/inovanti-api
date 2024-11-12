# Inovanti API

This project demonstrates the development of an API for product CRUD operations, including authentication via Laravel Sanctum. It follows modern development practices and adheres to high standards of PHP and Laravel development.

## Key Technologies
- **Laravel 11**
- **PHP 8.3**
- **PostgreSQL**

## Project Goals
The API was developed to showcase an REST API for product management with CRUD functionality, as well as authentication using Sanctum. This project aims to employ development patterns and best practices, including:

- **PSR (PHP Standards Recommendations)**
- **Clean Code Principles**
- **Test-Driven Development (TDD)**
- **Repository Pattern**
- **Strong Typing**

## Issues and Milestones
You can track the project’s issues and milestones at: [GitHub Issues](https://github.com/MuriloMelo94/inovanti-api/issues?q=is%3Aissue) 

CS50 introducing video: [click](https://youtu.be/tT-suhlltlU)

## Local Development Setup

To run the project locally, follow the steps below:

1. Clone the repository to your local machine.

2. Copy the `.env.example` file and rename it to `.env`:
    ```bash
    cp .env.example .env
    ```
3. Install application dependencies:
    ```bash
    composer install
    ```

4. Set up the PostgreSQL connection in the `.env` file by updating the `DB_USERNAME` and `DB_PASSWORD` values according to your PostgreSQL configuration.

5. Generate the application key:
    ```bash
    php artisan key:generate
    ```

6. Create a PostgreSQL database named `inovanti_api`:
    ```sql
    CREATE DATABASE inovanti_api;
    ```

7. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```

8. Start the Laravel development server:
    ```bash
    php artisan serve
    ```

9. Verify that the application is running by accessing the following route in your browser:
    ```
    http://localhost:8000
    ```
    This will return the system version and other application details.

10. Feel free to run tests by running:
    ```
    php artisan test --parallel
    ```

---
