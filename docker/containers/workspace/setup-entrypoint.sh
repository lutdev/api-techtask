#! /bin/bash
set -x

if [ ! -f "/var/www/.env" ];
then
    cp /var/www/.env.example .env;
else
    composer install;
fi

php artisan migrate

/bin/bash