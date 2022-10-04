# Picture works exam
ZenMart client exam codes

## Versions:
* PHP version used: **8.1.5**
* NodeJS used: **v16.15.1**
* Laravel Version: **8.x**

## Initial Setup
once you've done cloning, you must run `composer install` to install all the dependencies

**optional:** <br>
if you want to check if the laravel mix is compiling, or the sass or JS is compiling, please run `npm install` then `npm run watch` or `npm run dev` or `npm run prod` <br>

*if you are just going to check the output of the exam you don't need to do this as the assets, styling and scripts are already compiled once you clone it*

## Database
Setup a database in postgres with the name of your choice and copy this to .env, you can also use the values below by default:

<code>
DB_CONNECTION=pgsql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=5432<br>
DB_DATABASE=pictureworks<br>
DB_USERNAME=postgres<br>
DB_PASSWORD={password of your choice}
</code>

after you set up the database, you must now run `php artisan migrate --seed`

## Running the app
once the you are done with the setup above you can now run `php artisan serve`, please check `.env.example` as I've input the site info there.

**optional:**<br>
if you prefer to run this on a local domain, just change the `APP_URL` to the local domain you have chosen and run `php artisan serve --host="chosen.domain.com" --port=80`

## Usage
once you serve the application, you can now go to URL you've setup, it will redirect you to the users page (`/users/1`) immediately, **and please notice at the top:** the navigation to Backendside processing and AXAJ side processing as per instructions of the exam

**For the commmandline functionality:**
please run: `php artisan Users:AddComment --help` this will give you instructions for the required arguments

### Exam done by Radiant C. Juan <br>
for more info about me please check: <br>
[Portfolio website](https://radiantcjuan.me/) <br>
[GitHub](https://github.com/radiantjuan) <br>
[LinkedIn](https://www.linkedin.com/in/radiant-juan-2b495391/)



