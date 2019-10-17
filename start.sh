#!/bin/sh
copmoser update;
php artisan migrate:fresh;
php artisan db:seed;
php artisan jwt:secret
