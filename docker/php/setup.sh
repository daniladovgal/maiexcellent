#!/bin/sh

composer install

php artisan storage:link
php artisan optimize

exec $@
