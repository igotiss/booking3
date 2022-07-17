<p align="center"><a href="https://sigma.software" target="_blank"><img <img src="https://cdn.sigma.software/wp-content/themes/ems3/build/project/images/sigma-software-logo.svg" alt="Sigma Software logo" width="200" ></a></p>

<p align="center">
project of Sigma - CAMP
</p>

# About Project
## The following general technical requirements for the system are fulfilled:
- PHP - v8.1.1.
- Laravel - v8.83.18.
- Vue.js.
- web server: nginx
- DBMS-MySQL;
- Using Docker
- Application of Unit tests

І present to your attention a site whose main functionality is housing reservation.

## Description of general functionality

**1. Registration.**

Users can sign up by providing an email address and coming up with
password. In addition, the user can indicate his age and country of residence.

**2. Email confirmation.**

After registration, the user should receive an email from
link, by following which he can verify the affiliation
email address. Until the email address is verified, the user has
see a message that it needs verification. The user also
should be able to re-send the email with a reference to
email address confirmation.

**3. Personal profile.**

All information about the previous bookings is stored in the personal account
booking, left comments, administration own stays bookings, etc. Also users
can update, delete or change personal information here.

**4. Search.**

Any user, not necessarily registered, can
search for housing. The site has implemented a search bar
to which you can specify the destination, the number of tourists and rooms, and
also the date. The search system itself is simple and convenient.

**5. Filters**

The site is equipped with a convenient filter system that simplifies actions
user. Available filters:
- *budget for the night,*
- *number of stars,*
- *type of accommodation,* 
- *quantity beds,*
- *review-rating,* 
- *amenities.*


**6. Ratings**

The project implements two rating systems - by stars and by reviews (see reviews)

**7. Reviews**

Users with a verified email can leave reviews. Also, when writing a review, the user can leave a rating for the review. In addition, in the personal account, the user can view all the reviews he has left, and reviews left by other users on the user's own objects

**8. Options for hotel owners and management. (Booking administration).**

A registered users can register a property that they intend to provide for rent. Property data includes information that will be displayed to customers:

- *details of the object - number of rooms, availability of amenities, etc.;*
- *photo;*
- *detailed description, payment details.*

In addition, in their own profile, owners can add or delete properties etc.

 **9. Booking management**

Here, property owners can manage all their properties
reservations, as well as cancel them if necessary without payment. In addition, there is a page where the client's own bookings (for other people's real estate) are collected.

 **10. System announcements**

A CRUD system of ads is implemented, which are shown to all registered users, but only the site administrator can add/change/delete ads.

## Minimum requirements for project installation

- [Ubuntu 20.04](https://releases.ubuntu.com/20.04/) 
- [Docker version  20.10.16](https://docs.docker.com/desktop/linux/install/)  
- [Composer version 2.1.14](https://getcomposer.org/download/) 
- [NodeJs version 2.1.14](https://nodejs.org/uk/download/)  
- [npm version 8.13.2](https://docs.npmjs.com/cli/v8/commands/npm-install)  


## Quick start

1. Clone project from [repository](https://github.com/igotiss/booking3.git).
2. Run `composer install` in terminal
3. Rename `.env.example` to `.env` and updated it with your database credentials
4. Run the command `./vendor/bin/sail up` in the terminal
5. Run `./vendor/bin/sail artisan key:generate`
6. Run `./vendor/bin/sail artisan migrate --seed`
7. Run `npm install` 
8. Run `npm run dev` and enjoy!

## Additional - adding and setting up Nginx and PHP-fpm in Laravel Sail
By defaul thae project is work by native Sail components. But if you need to install Nginx uses the [repo and instruction](https://github.com/acadea/laravel-sail-nginx-php-fpm)    
## ********
Developed by [Igor Tyshchenko](mailto:igotiss@gmail.com)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
