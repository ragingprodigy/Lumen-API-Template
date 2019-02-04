#!/usr/bin/env bash

echo 'Running start.sh ...'
set -e

role=${CONTAINER_ROLE:-app}
queue_name=${QUEUE_NAME:-default}
artisan_cmd=${ARTISAN_CMD:-help}

echo "Container Role is \"$role\"..."

if [ "$role" = "app" ]; then

    exec php-fpm -RF

elif [ "$role" = "queue" ]; then

    echo "Running the \"$queue_name\" queue..."
    php /var/www/application/artisan queue:work --queue="$queue_name" --verbose --tries=3 --timeout=0 --sleep=30

elif [ "$role" = "artisan" ]; then

    echo "Running artisan command \"$artisan_cmd\""
    php /var/www/application/artisan ${artisan_cmd}

elif [ "$role" = "scheduler" ]; then

    while [ true ]
    do
      php /var/www/application/artisan schedule:run --verbose --no-interaction &
      sleep 60
    done

else
    echo "Could not match the container role \"$role\""
    exit 1
fi