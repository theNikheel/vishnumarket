# FROM php:8.0-apache as base

# FROM php:7.4-fpm-alpine as base

# EXPOSE 9000

# RUN apk update && apk add --no-cache \
#     build-base \
#     shadow \
#     vim \
#     curl \
#     php-fpm \
#     php-common \
#     php-cli \
#     php-pdo_mysql \
#     php-openssl \
#     php-session \
#     php-dom \
#     php-session \
#     php-json \
#     php-gd \
#     php-intl \
#     php-mbstring \
#     php-opcache \
#     php-pdo \
#     php-xml \
#     php-zip \   
#     php-zlib

# COPY . /var/www/html
# CMD ["php-fpm"]


FROM php:7.1.23-apache
WORKDIR /
COPY . /var/www/html
# RUN echo "ServerName localhost:80" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]


# # FROM php:7.1.23-apache
# # COPY . /var/www/html
# # RUN docker-php-ext-install pdo_mysql
# # CMD ["apache2ctl", "-D", "FOREGROUND"]