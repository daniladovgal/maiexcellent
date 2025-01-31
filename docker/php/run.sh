#!/bin/sh

php artisan migrate

php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000 --workers=4

exec $@
