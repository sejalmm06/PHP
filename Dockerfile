FROM php:8.1-apache

# Install necessary dependencies, including libonig-dev for mbstring
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install pdo mbstring

RUN a2enmod rewrite

WORKDIR /var/www/html
COPY . /var/www/html

#COPY .env.example .env

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

RUN git config --global --add safe.directory /var/www/html

RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html

#RUN composer update
RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]
