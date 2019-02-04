#!/usr/bin/env bash
# This setup we should use only for DEV/TEST mode

echo 'Running setup.sh ...'

set -e
cd /var/www/application/

#------------------------------------Prepare DEV environment------------------------------------#
echo '> Install dependencies'
php -d memory_limit=-1 /bin/composer install --working-dir /var/www/application

