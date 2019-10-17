#!/bin/sh
php composer update;
php artisan migrate:fresh;
php artisan db:seed;
php arisan jwt:secret