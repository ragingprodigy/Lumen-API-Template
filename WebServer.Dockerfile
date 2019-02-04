FROM nginx:1.13
COPY ./docker/WebServer/default.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www/application