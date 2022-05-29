## Prerequisites
1. Composer installed
2. PHP 8 or above installed
3. NPM installed
4. MySQL installed

## Project Setup Instructions

1. Clone the repository
2. Get inside the project's root directory via a terminal
3. Run `composer install`
4. Run `npm install`
5. Edit your .env for connecting with database. Use the .env.example file to create your .env file and edit the following variables
		DB_CONNECTION=mysql
		DB_HOST=Your database host
		DB_PORT=Your database port
		DB_DATABASE=Your database name(Create database beforehand)
		DB_USERNAME=Your database username
		DB_PASSWORD=Your database password
6. Back inside terminal run `php artisan migrate`
7. Run `php artisan key:generate`
8. Run `php artisan storage:link`
9. Run `php artisan serve` & `npm run watch` to host the application
10. Access the app by going to the location where its hosted from your browser

## Screenshots are included in the root directory
