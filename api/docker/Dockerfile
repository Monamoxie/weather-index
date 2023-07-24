FROM php:8.1-apache

RUN apt-get update

RUN apt-get install -y \
    cron \
    pkg-config  \
    libzip-dev

RUN docker-php-ext-install \
    mysqli \
    pdo_mysql \
    zip

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Give execution rights on the cron job
RUN chmod 0644 /etc/crontab
RUN touch /var/log/cron.log
RUN echo "* * * * * cd /var/www/html && php artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/crontab
RUN echo "# End of line" >> /etc/crontab

# Apply cron job
RUN crontab /etc/crontab
# Change CMD to have cron running
RUN echo "#!/bin/sh\ncron\n/usr/local/bin/apache2-foreground" > /usr/bin/run
RUN chmod u+x /usr/bin/run
CMD ["run"]

RUN a2enmod rewrite
RUN service apache2 restart
