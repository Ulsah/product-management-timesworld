## About Project

This is a simple appointment system built for a task given by Hulkapps. The project was built using Laravel, VueJS and MySQL as database. The front end was implemented with the help of VueJS and AdminLTE. PHP 8 and Composer 2 are also required to run the application. The backend runs on Laravel 8. The app contains three usertypes which are listed below:

Admin- Manage Appointments & users
Doctor- Manage Appointments assigned to the user and upload reports of appointments
User- Request appointments and manage their appointments

This is an implementation of the system in a very basic form. The first task was also included in the project on a small scale. A mysql export is added in the root directory.

## Project Setup Instructions

1. Clone the repository
2. Get inside the project root directory via a terminal
3. Run `composer install`
4. Run `npm install`
5. Edit your .env for connecting with database
6. Back inside terminal run `php artisan migrate`
7. Run `php artisan key:generate`
8. Run `php artisan serve` & `npm run watch` to host the application
9. Access the app by going to the location where its hosted from your browser
10. Add the mysql export into your database
11. Login using email: udalexk@gmail.com and password: techtips as admin to view users
12. Default password for users are:
			Admin type: techtipsAdmin
			Doctor type: techtipsDoctor
			User type: techtipsUser
		Use this to login as different users and use the app. P.S: Default passwords are only applied when admin creates a user. When using registering from register page your own password can be created.

## Approach

I approached the project with the aim of finishing the basic implementation as soon as possible. I had very limited time and I had to finish it before deadline. The hardest part was definitely making it a SPA. Gates and access control was implemented in the front end. I loved how thrilling it was finishing the project within deadline however I disliked how little time I had.

## Estimated time

16 hours


## Pending

1. ACL in backend
2. Implementing an authentication system such as Sanctum or Passport
