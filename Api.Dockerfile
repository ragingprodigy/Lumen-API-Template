FROM ragingprodigy/php-7.1-fpm
MAINTAINER o.omonayajo@gmail.com

ENV TERM dump
ENV START_MESSAGE Application has been installed
ENV LOCK_FILE_PATH /tmp/application.lock

COPY ./docker/Api/bin /usr/local/bin/app
COPY . /var/www/application

ARG IS_DEV_MODE

RUN chmod +x /usr/local/bin/app/* && \
    chown -R www-data:www-data /var/www/application/storage
RUN if [ -n "$IS_DEV_MODE" ]; then /usr/local/bin/app/install_dev.sh; fi

RUN sed -i "s/www-data/root/g" /usr/local/etc/php-fpm.d/www.conf
RUN php -d memory_limit=-1 /bin/composer install \
        --no-ansi \
        --no-dev \
        --prefer-dist \
        --no-interaction \
        --no-progress \
        --no-scripts \
        --optimize-autoloader \
        --working-dir \
            /var/www/application \
    && \
    touch /var/www/application/storage/logs/lumen.log && chmod 777 /var/www/application/storage/logs/lumen.log
WORKDIR /var/www/application

RUN printf "alias art='php artisan'\n" >> /root/.bashrc

CMD /usr/local/bin/app/run.sh
