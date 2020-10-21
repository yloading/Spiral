# Apollo Spiral

## Description

A basic web application that shows multiple random 5-character string in a spiral manner. Built with Laravel and Vue.js.

### Quick Start
1. Make sure that you have Node.js v12.18.1 and npm v6 or above installed in your machine.
2. Clone this repo using `git clone https://github.com/yloading/Spiral.git <YOUR_PROJECT_NAME>`.
3. Go to your project directory. (e.g. cd `<YOUR_PROJECT_NAME>`)
4. Run `composer install` to install composer dependencies.
5. Run `npm install` to install all dependencies in `package.json`.
6. Run `copy .env.example .env` and change the `DB_CONNECTION` from `mysql` to `sqlite`. Remove other `DB` keys except `DB_CONNECTION` in .env file.
7. Run `php artisan key:generate` to generate application encryption key.
8. Run `touch database/database.sqlite` to create a sqlite database file.
9. Run `php artisan migrate` to migrate the database.

Now you're ready to go!

> Note: You can change the number of characters that is being displayed by changing the parameter value of `setFlag(*int*)`.


