#!/usr/bin/env bash

echo 'Running pre_run.sh ...'
set -e
cd /var/www/application/

echo 'Migrate Database...'
php artisan migrate --database=default --step

echo $START_MESSAGE
touch $LOCK_FILE_PATH
