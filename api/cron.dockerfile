FROM php:8.1-apache

COPY crontab /etc/crontabs/root

CMD ["crond", "-f"]