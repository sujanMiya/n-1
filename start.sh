#!/bin/sh

# Fix permissions for runtime mounted volumes
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

exec "$@"
