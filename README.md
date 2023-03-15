Installation
To install the project, follow these steps:

    1. Clone the project repository to your local machine using the command git clone <repository_url>.
    2. Navigate to the cloned project folder in your terminal.
    3. Run the command composer install to install Laravel dependencies.
    4. Copy the .env.example file and rename it to .env.
    5. Generate a new application key using the command php artisan key:generate.
    6. Configure the database credentials in the .env file. Be sure to update the values of DB_DATABASE, DB_USERNAME, and DB_PASSWORD with your own credentials.
    7. Run the migrations by running ` php artisan migrate ` in the terminal.
    8. Run the seeders by running ` php artisan db:seed ` in the terminal.
    9. To rollback a migration, run ` php artisan migrate:rollback ` in the terminal. To rollback multiple migrations, use the ` --step ` option.
    10. To rollback a seeder, run ` php artisan db:seed --class=<SeederName> --force --seed `.
    11. To run the project, execute the command `php artisan serve` in the terminal and then go to the URL that appears in the terminal to access the views of the project.