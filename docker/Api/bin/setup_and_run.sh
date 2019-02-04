#!/usr/bin/env bash

set -e
cd /var/www/application/

echo 'Running setup_and_run.sh ...'

/usr/local/bin/app/setup.sh
/usr/local/bin/app/pre_run.sh

echo 'Seed dev database ...'
php artisan db:seed --database=default

/usr/local/bin/app/start.sh
