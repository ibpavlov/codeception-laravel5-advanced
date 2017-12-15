# Sample Laravel Application with Codeception tests.

[![Build Status](https://travis-ci.org/janhenkgerritsen/codeception-laravel5-sample.svg?branch=codeception-2.1)](https://travis-ci.org/janhenkgerritsen/codeception-laravel5-sample)

### Setup

You can setup this sample manually or use [Vagrant](https://www.vagrantup.com/) to automatically set up a development environment for you.

#### Manual
- Clone repo
- Create your .env file from the example file: `cp .env.testing .env`
- Install composer dependencies: `composer install`
- Create databases by creating the following files:
    - `storage/database.sqlite`
    - `storage/testing.sqlite`
- Run the following commands:
    - `php artisan migrate`
    - `php artisan migrate --database=sqlite_testing`
- Server: run `php -S localhost:8000 -t public`
- Browse to localhost:8000/posts

#### Vagrant
- Clone repo
- Cd into the cloned directory
- Install git submodules: `git submodule update --init --recursive`
    - you can also add the `--recursive` flag to the `git clone` command to skip this step
- Run `vagrant up`

To SSH into the machine to run your tests, run `vagrant ssh`. You can access the app on the guest VM under http://192.168.10.10/.

### To test

Run Codeception, installed via Composer

```
./vendor/bin/codecept build
./vendor/bin/codecept run
```

## Tests

Please check out `/tests` folder for some good test examples provided.

### Functional Tests

Demonstrates testing of CRUD application with

* PageObjects
* authentication (by user, credentials, http auth)
* usage of session variables
* routes
* creating and checking records in database
* testing of form errors

### API Tests

Demonstrates functional testing of API using REST and Laravel5 modules connected, with

* partial json inclusion in response
* GET/POST/PUT/DELETE requests
* check changes inside database
