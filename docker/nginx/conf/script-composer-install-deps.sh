#!/bin/sh

cd /var/www/html/camagru/
composer.phar install
composer.phar dump-autoload
