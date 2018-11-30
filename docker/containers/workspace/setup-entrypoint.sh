#! /bin/bash
set -x

if [ ! -f "/var/www/.env" ];
then
    composer create-project && php artisan jwt:secret;
else
    composer install;
fi

php artisan migrate --seed

/bin/bash