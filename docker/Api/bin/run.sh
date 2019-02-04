#!/usr/bin/env bash

echo 'Running run.sh ...'
set -e
cd /var/www/application/

/usr/local/bin/app/pre_run.sh
/usr/local/bin/app/start.sh
